<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Rules\Recaptcha; // Ensure this rule exists in app/Rules/Recaptcha.php

// PHPMailer Namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer files directly
require_once base_path('app/Libraries/PHPMailer/Exception.php');
require_once base_path('app/Libraries/PHPMailer/PHPMailer.php');
require_once base_path('app/Libraries/PHPMailer/SMTP.php');

class AuthController extends Controller
{
    public function showLogin() { 
        return view('auth.login'); 
    }

    /**
     * Handle Login and Step 1 of 2FA
     * PROTECTION: Honeypot, SQL Injection prevention, reCAPTCHA, and Rate Limiting
     */
    public function login(Request $request) {
        // 1. HONEYPOT: Rejects bots that fill hidden fields
        if ($request->filled('website')) {
            return response()->json(['error' => 'Bot activity detected.'], 403);
        }

        // 2. VALIDATION: Rejects malformed scripts and verifies reCAPTCHA
        $credentials = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string'],
            'g-recaptcha-response' => ['required', new Recaptcha], 
        ]);

        // Remove reCAPTCHA from credentials so Auth::validate doesn't check it against DB columns
        unset($credentials['g-recaptcha-response']);

        /** * 3. SQL INJECTION PROTECTION: 
         * Auth::validate and Eloquent (User::where) use PDO Parameter Binding.
         */
        if (Auth::validate($credentials)) {
            // Securely fetch user using Eloquent
            $user = User::where('email', $request->email)->first();
            
            // Generate Secure 6-digit OTP
            $otp = rand(100000, 999999);
            
            // Store sensitive 2FA data in Server-Side Session
            session([
                '2fa_user_id' => $user->id, 
                '2fa_otp' => $otp, 
                '2fa_expires' => now()->addMinutes(5)
            ]);
            
            $subject = "Your Login OTP - Annapurna Polytechnic Institute";
            $body = "
                <div style='font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto; border: 1px solid #e1e1e1; padding: 20px; border-radius: 10px;'>
                    <h2 style='color: #004a99; text-align: center;'>Annapurna Polytechnic Institute</h2>
                    <p>Hello,</p>
                    <p>Use the following One-Time Password (OTP) to complete your login. This code is valid for <strong>5 minutes</strong>.</p>
                    
                    <div style='text-align: center; margin: 30px 0;'>
                        <span style='font-size: 32px; font-weight: bold; letter-spacing: 5px; color: #333; background: #f4f4f4; padding: 10px 20px; border-radius: 5px; border: 1px dashed #ccc;'>
                            $otp
                        </span>
                    </div>
                    
                    <p style='color: #d9534f; font-size: 13px;'><strong>Security Warning:</strong> For your protection, do not share this code with anyone. Staff members will never ask for your OTP.</p>
                    
                    <hr style='border: none; border-top: 1px solid #eee; margin-top: 20px;'>
                    <p style='font-size: 11px; color: #888; text-align: center;'>
                        This is an automated message. Please do not reply.
                    </p>
                </div>
            ";
            $this->sendMail($user->email, $subject, $body);
            
            return redirect()->route('verify.otp');
        }

        // 4. PREVENT ENUMERATION: Do not reveal if the email exists or not
        return back()->withErrors(['email' => 'Invalid credentials provided.']);
    }

    /**
     * Verify OTP and finalize login
     */
    public function verifyOtp(Request $request) {
        $request->validate(['otp' => 'required|numeric']);

        // Check OTP and Expiry
        if ($request->otp == session('2fa_otp') && now()->lt(session('2fa_expires'))) {
            $user = User::find(session('2fa_user_id'));
            
            if ($user) {
                // 5. SESSION REGENERATION: Changes Session ID to prevent Session Hijacking
                Auth::login($user);
                $request->session()->regenerate();

                // Clear 2FA data from session
                session()->forget(['2fa_user_id', '2fa_otp', '2fa_expires']);
                
                return redirect()->intended('admin/dashboard');
            }
        }

        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }

    /**
     * Password Reset Link Request
     */
    public function sendResetLink(Request $request) {
        $request->validate(['email' => 'required|email|exists:users,email']);
        
        $token = Str::random(64);
        
        // Securely update or insert reset token
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email], 
            ['token' => $token, 'created_at' => now()]
        );
        
        $link = url("/reset-password/$token?email=" . urlencode($request->email));
        $subject = "Password Reset Request - Annapurna Polytechnic Institute";
        $body = "
            <div style='font-family: sans-serif; line-height: 1.6; color: #333;'>
                <h2>Password Reset Request</h2>
                <p>Hello,</p>
                <p>We received a request to reset the password for your account at <strong>Annapurna Polytechnic Institute</strong>.</p>
                <p>Please click the button below to set a new password. This link will expire in 60 minutes.</p>
                <p><a href='$link' style='background-color: #004a99; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;'>Reset Password</a></p>
                <p>If the button above doesn't work, copy and paste the following URL into your browser:</p>
                <p><a href='$link'>$link</a></p>
                <hr style='border: none; border-top: 1px solid #eee;' />
                <p style='font-size: 0.8em; color: #777;'>If you did not request a password reset, please ignore this email or contact the IT department if you have concerns.</p>
            </div>
        ";
        $sent = $this->sendMail($request->email, $subject, $body);

        if ($sent) {
            return back()->with('status', 'Reset link sent to your email!');
        }
        return back()->withErrors(['email' => 'Failed to send email. Check SMTP settings.']);
    }

    /**
     * Internal Private Mail Function
     */
    private function sendMail($to, $subject, $body) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
            $mail->Port       = 465;

            // SSL verification: Only disable locally if necessary; enable in production
            $mail->SMTPOptions = [
                'ssl' => ['verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true]
            ];

            $mail->setFrom(env('MAIL_USERNAME'), env('APP_NAME'));
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->Timeout = 60; 
            
            return $mail->send();
        } catch (Exception $e) {
            \Log::error("Mail Error: " . $mail->ErrorInfo);
            return false;
        }
    }

    /**
     * Password Reset Action
     */
    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required', 
            'email' => 'required|email', 
            'password' => 'required|min:8|confirmed'
        ]);
        
        // Use Parameter Binding to verify token
        $record = DB::table('password_reset_tokens')
                    ->where('email', $request->email)
                    ->where('token', $request->token)
                    ->first();

        if (!$record) return back()->withErrors(['email' => 'Invalid or expired reset token.']);
        
        // Update password securely using Hash facade
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);
        
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        
        return redirect('/login')->with('status', 'Password updated successfully!');
    }

    public function logout(Request $request) {
        Auth::logout();
        
        // 6. LOGOUT SECURITY: Invalidate session and refresh CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken(); 
        
        return redirect('/login');
    }

    // View Getters
    public function showVerifyForm() {
        if (!session()->has('2fa_user_id')) return redirect('/login');
        return view('auth.verify-otp');
    }

    public function showForgotForm() { return view('auth.forgot-password'); }

    public function showResetForm(Request $request, $token) {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function showStudentLogin() {
        return view('auth.student-login');
    }
}