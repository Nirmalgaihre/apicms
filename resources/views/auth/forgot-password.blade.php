<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Annapurna Polytechnic Institute</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    /* Re-using your exact Institute Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }

    body {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f0f2f5;
    }

    .login-container {
        display: flex;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        width: 100%;
        margin: 20px;
    }

    .login-left {
        flex: 1;
        padding: 2rem;
        background: #e8ecef;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .login-left img {
        max-width: 100px;
        width: 40%;
        height: auto;
        margin-bottom: 2rem;
    }

    .login-left h2 {
        font-size: 1.1rem;
        color: #003366;
        text-align: center;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .login-right {
        flex: 1;
        padding: 2.5rem;
    }

    .login-right h1 {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    /* Success Message Style */
    .success-message {
        color: #155724;
        background: #d4edda;
        padding: 10px;
        border-radius: 5px;
        font-size: 0.85rem;
        text-align: center;
        margin-bottom: 1rem;
        border: 1px solid #c3e6cb;
    }

    .error-message {
        color: #d32f2f;
        background: #ffebee;
        padding: 10px;
        border-radius: 5px;
        font-size: 0.85rem;
        text-align: center;
        margin-bottom: 1rem;
    }

    .form-group {
        margin-bottom: 1.2rem;
    }

    .form-group label {
        display: block;
        font-size: 0.9rem;
        color: #333;
        margin-bottom: 0.3rem;
    }

    .form-group input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 0.95rem;
    }

    .login-btn {
        width: 100%;
        padding: 0.8rem;
        background: #1a3c6d;
        border: none;
        border-radius: 5px;
        color: #fff;
        font-size: 1rem;
        cursor: pointer;
        font-weight: bold;
    }

    .login-btn:hover {
        background: #14305a;
    }

    .back-to-login {
        text-align: center;
        margin-top: 1rem;
    }

    .back-to-login a {
        color: #1a3c6d;
        font-size: 0.85rem;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .login-left {
            display: none;
        }

        .login-container {
            max-width: 450px;
        }
    }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-left">
            <img src="{{ asset('assets/img/logo.png') }}" alt="API Logo">
            <h2>Annapurna Polytechnic Institute</h2>
            <p>Annapurna 3, Kahundanda, Kaski, Nepal</p>
        </div>

        <div class="login-right">
            <h1>Reset Password</h1>

            @if (session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
            @endif

            <p style="font-size: 0.85rem; color: #666; margin-bottom: 1.5rem; text-align: center;">
                Enter your email address and we will send you a link to reset your password.
            </p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your registered email" required>
                </div>

                <button type="submit" class="login-btn">Send Reset Link</button>

                <div class="back-to-login">
                    <a href="{{ url('/login') }}"><i class="fas fa-arrow-left"></i> Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>