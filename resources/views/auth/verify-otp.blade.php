<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP | Annapurna Polytechnic Institute</title>
    <style>
    body {
        font-family: sans-serif;
        background: #f4f7f6;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .card {
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    h2 {
        color: #1a3c6d;
        margin-bottom: 10px;
    }

    p {
        color: #666;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .otp-group {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 25px;
    }

    .otp-input {
        width: 45px;
        height: 55px;
        border: 2px solid #ddd;
        border-radius: 8px;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }

    .otp-input:focus {
        border-color: #1a3c6d;
        outline: none;
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        background: #1a3c6d;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        font-weight: bold;
    }

    .btn-submit:hover {
        background: #14305a;
    }

    .error-msg {
        color: #721c24;
        background: #f8d7da;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        font-size: 13px;
    }

    .resend {
        margin-top: 15px;
        font-size: 13px;
    }

    .resend a {
        color: #1a3c6d;
        text-decoration: none;
        font-weight: bold;
    }
    </style>
</head>

<body>

    <div class="card">
        <h2>OTP Verification</h2>
        <p>Enter the 6-digit code sent to your email.</p>

        @if($errors->any())
        <div class="error-msg">{{ $errors->first() }}</div>
        @endif

        <form id="otpForm" method="POST" action="{{ url('/verify-otp') }}">
            @csrf
            <!-- This holds the final 6-digit string -->
            <input type="hidden" name="otp" id="hiddenOtp">

            <div class="otp-group">
                @for ($i = 0; $i < 6; $i++) <input type="text" class="otp-input" maxlength="1" inputmode="numeric"
                    required {{ $i == 0 ? 'autofocus' : '' }}>
                    @endfor
            </div>

            <button type="submit" class="btn-submit">Verify & Login</button>
        </form>

        <div class="resend">
            Didn't get code? <a href="{{ url('/login') }}">Go back</a> or check Spam.
        </div>
    </div>

    <script>
    const inputs = document.querySelectorAll('.otp-input');
    const hiddenInput = document.getElementById('hiddenOtp');

    inputs.forEach((input, index) => {
        // Auto-focus next input
        input.addEventListener('input', (e) => {
            if (e.target.value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
            combineOtp();
        });

        // Handle Backspace
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });

    function combineOtp() {
        let code = "";
        inputs.forEach(i => code += i.value);
        hiddenInput.value = code;
    }
    </script>

</body>

</html>