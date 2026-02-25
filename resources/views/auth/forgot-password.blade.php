<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | SmartAdmin CRM</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            padding: 20px;
        }

        .card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.4);
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .icon-wrap {
            width: 70px; height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            display: flex; align-items: center; justify-content: center;
            font-size: 28px; color: #fff;
            margin: 0 auto 20px;
            box-shadow: 0 8px 20px rgba(99,102,241,0.4);
        }

        h1 { color: #fff; font-size: 1.6rem; font-weight: 700; text-align: center; margin-bottom: 8px; }

        .subtitle {
            color: rgba(255,255,255,0.55);
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 28px;
            line-height: 1.5;
        }

        .alert {
            border-radius: 10px;
            padding: 13px 16px;
            font-size: 0.88rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success { background: rgba(16,185,129,0.15); border: 1px solid rgba(16,185,129,0.4); color: #34d399; }
        .alert-error   { background: rgba(239,68,68,0.15);  border: 1px solid rgba(239,68,68,0.4);  color: #f87171; }

        .form-group { margin-bottom: 20px; }

        label {
            display: block;
            color: rgba(255,255,255,0.75);
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .input-wrap { position: relative; }

        input[type="email"] {
            width: 100%;
            padding: 13px 16px 13px 45px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            color: #fff;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.3s, background 0.3s;
            outline: none;
        }

        input[type="email"]:focus {
            border-color: #6366f1;
            background: rgba(255,255,255,0.1);
        }

        input::placeholder { color: rgba(255,255,255,0.3); }

        .input-icon {
            position: absolute;
            left: 15px; top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.35);
            font-size: 0.9rem;
        }

        .error-text { color: #f87171; font-size: 0.8rem; margin-top: 5px; }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 8px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99,102,241,0.4);
        }

        .btn-submit:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: rgba(255,255,255,0.5);
            font-size: 0.88rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-link:hover { color: #fff; }
        .back-link i { margin-right: 5px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon-wrap">
            <i class="fas fa-envelope-open-text"></i>
        </div>

        <h1>Forgot Password?</h1>
        <p class="subtitle">
            Enter your registered email address and we'll send you a password reset link.
        </p>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('forgot.password.send') }}" method="POST" id="forgotForm">
            @csrf

            <div class="form-group">
                <label>Email Address</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" value="{{ old('email') }}"
                           placeholder="Enter your email address" required>
                </div>
                @error('email')
                    <div class="error-text"><i class="fas fa-circle-xmark"></i> {{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit" id="sendBtn">
                <i class="fas fa-paper-plane"></i> Send Reset Link
            </button>
        </form>

        <a href="{{ route('login') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Login
        </a>
    </div>

    <script>
        document.getElementById('forgotForm').addEventListener('submit', function() {
            var btn = document.getElementById('sendBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
        });
    </script>
</body>
</html>
