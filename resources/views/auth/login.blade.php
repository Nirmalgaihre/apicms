<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Annapurna Polytechnic Institute </title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    /* Including your exact CSS styles */
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
        width: 60%;
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

    .login-left h5 {
        font-size: 1rem;
        color: #333;
        text-align: center;
        margin-bottom: 0.5rem;
    }

    .login-left p {
        font-size: 0.85rem;
        color: #555;
        text-align: center;
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
        position: relative;
    }

    .form-group label {
        display: block;
        font-size: 0.9rem;
        color: #333;
        margin-bottom: 0.3rem;
    }

    .form-group input {
        width: 100%;
        padding: 0.75rem 0.75rem;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 0.95rem;
    }

    .form-group input:focus {
        outline: none;
        border-color: #1a3c6d;
        box-shadow: 0 0 5px rgba(26, 60, 109, 0.2);
    }

    .form-group.password-field i {
        position: absolute;
        right: 12px;
        top: 38px;
        color: #555;
        cursor: pointer;
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
        transition: background 0.3s ease;
        font-weight: bold;
    }

    .login-btn:hover {
        background: #14305a;
    }

    .forgot-password {
        text-align: center;
        margin-top: 1rem;
    }

    .forgot-password a {
        color: #1a3c6d;
        font-size: 0.85rem;
        text-decoration: none;
    }

    .form-group.checkbox {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .form-group.checkbox input {
        width: auto;
        margin-right: 0.5rem;
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
            <h2>Council for Technical Education and Vocational Training (CTEVT)</h2>
            <h5>Annapurna Polytechnic Institute</h5>
            <p>Annapurna 3, Kahundanda, Kaski, Nepal</p>
        </div>

        <div class="login-right">
            <h1>Login Portal</h1>

            @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ url('/login') }}">
                @csrf
                <input type="text" name="website" style="display:none !important" tabindex="-1" autocomplete="off">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required
                        value="{{ old('email') }}">
                </div>

                <div class="form-group password-field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <i class="fas fa-eye" id="togglePassword"></i>
                </div>

                <div class="form-group checkbox">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember Me</label>
                </div>
                <div class="form-group" style="display: flex; justify-content: center; margin-bottom: 1rem;">
                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                </div>


                <button type="submit" class="login-btn">Sign In</button>

                <div class="forgot-password">
                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>

    <script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#password');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>