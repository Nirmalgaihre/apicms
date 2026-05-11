<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Annapurna Polytechnic Institute</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Re-using your exact Institute Styles */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Arial', sans-serif; }
        body { min-height: 100vh; display: flex; justify-content: center; align-items: center; background: #f0f2f5; }
        .login-container { display: flex; background: #fff; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); max-width: 800px; width: 100%; margin: 20px; }
        .login-left { flex: 1; padding: 2rem; background: #1a3c6d; color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; }
        .login-right { flex: 1; padding: 2.5rem; }
        .login-right h1 { font-size: 1.5rem; color: #333; margin-bottom: 1.5rem; text-align: center; }
        .form-group { margin-bottom: 1.2rem; }
        .form-group label { display: block; font-size: 0.9rem; color: #333; margin-bottom: 0.3rem; }
        .form-group input { width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 5px; }
        .login-btn { width: 100%; padding: 0.8rem; background: #1a3c6d; border: none; border-radius: 5px; color: #fff; font-weight: bold; cursor: pointer; }
        .error-message { color: #d32f2f; background: #ffebee; padding: 10px; border-radius: 5px; font-size: 0.85rem; text-align: center; margin-bottom: 1rem; }
        @media (max-width: 768px) { .login-left { display: none; } }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <h2>Secure Your Account</h2>
            <p style="text-align:center; margin-top:10px;">Please choose a strong password that you haven't used before.</p>
        </div>

        <div class="login-right">
            <h1>New Password</h1>

            @if ($errors->any())
                <div class="error-message">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" placeholder="At least 8 characters" required>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Repeat new password" required>
                </div>

                <button type="submit" class="login-btn">Update Password</button>
            </form>
        </div>
    </div>
</body>
</html>