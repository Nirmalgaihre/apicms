<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class UserController extends Controller
{
    public function index() {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create() {
        return view('admin.users.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'must_change_password' => true, // Force change on first login
        ]);

        $this->sendCredentialsEmail($request->email, $request->name, $request->password, "Account Created");

        return redirect()->route('users.index')->with('success', 'User created and email sent!');
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->must_change_password = true; // Force change again if admin resets it
            $this->sendCredentialsEmail($user->email, $user->name, $request->password, "Account Updated / Password Reset");
        }

        $user->save();
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Settings Method: Allows logged-in users to change their own password
     */
    public function updateSettings(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match our records.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->must_change_password = false; // Flag cleared
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }

    public function destroy($id) {
        if(auth()->id() == $id) return back()->with('error', 'You cannot delete yourself!');
        User::findOrFail($id)->delete();
        return back()->with('success', 'User deleted!');
    }

    private function sendCredentialsEmail($email, $name, $password, $subjectType) {
        $path = base_path('app/Libraries/PHPMailer/');

        require_once $path . 'Exception.php';
        require_once $path . 'PHPMailer.php';
        require_once $path . 'SMTP.php';

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = env('MAIL_HOST', 'smtp.gmail.com');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = env('MAIL_PORT', 587); 

            $mail->setFrom(env('MAIL_USERNAME'), env('APP_NAME'));
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "$subjectType - API CMS";
            $mail->Body = "
                <div style='font-family: Arial, sans-serif; max-width: 550px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;'>
                    <div style='background-color: #1d0647; padding: 20px; text-align: center;'>
                        <h2 style='color: #ffffff; margin: 0; font-size: 22px;'>$subjectType</h2>
                    </div>
                    <div style='padding: 30px; color: #333; line-height: 1.6;'>
                        <p style='font-size: 16px;'>Hello <b>$name</b>,</p>
                        <p>Your login credentials for the <strong>Annapurna Polytechnic Institute (API) CMS</strong> have been successfully generated.</p>
                        
                        <div style='background: #f9f9f9; border: 1px dashed #ccc; padding: 20px; border-radius: 8px; margin: 20px 0; text-align: center;'>
                            <p style='margin: 0 0 10px 0;'><strong>Email:</strong> <span style='color: #1d0647;'>$email</span></p>
                            <p style='margin: 0;'><strong>Temporary Password:</strong> <span style='color: #d9534f; font-family: monospace; font-size: 18px;'>$password</span></p>
                        </div>

                        <div style='text-align: center; margin: 30px 0;'>
                            <a href='" . url('/login') . "' style='background-color: #1d0647; color: #ffffff; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold;'>Login to Dashboard</a>
                        </div>

                        <p style='font-size: 13px; color: #666;'>
                            <strong>Important:</strong> For security reasons, you will be required to change this password immediately after your first login.
                        </p>
                    </div>
                    <div style='background-color: #f4f4f4; padding: 15px; text-align: center; font-size: 11px; color: #888;'>
                        If you did not request these credentials, please contact the IT Department immediately.<br>
                        &copy; " . date('Y') . " API CMS System
                    </div>
                </div>";
            $mail->send();
        } catch (Exception $e) {
            \Log::error("Mail failed: " . $mail->ErrorInfo);
        }
    }
}