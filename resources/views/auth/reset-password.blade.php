<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | SmartAdmin CRM</title>
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
            max-width: 450px;
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
            background: linear-gradient(135deg, #10b981, #059669);
            display: flex; align-items: center; justify-content: center;
            font-size: 28px; color: #fff;
            margin: 0 auto 20px;
            box-shadow: 0 8px 20px rgba(16,185,129,0.4);
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
        .alert-error { background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.4); color: #f87171; }

        .form-group { margin-bottom: 20px; }

        label {
            display: block;
            color: rgba(255,255,255,0.75);
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .input-wrap { position: relative; }

        input[type="password"], input[type="text"], input[type="email"] {
            width: 100%;
            padding: 13px 45px 13px 16px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            color: #fff;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.3s, background 0.3s;
            outline: none;
        }

        input[type="email"] { padding-right: 16px; }

        input:focus {
            border-color: #10b981;
            background: rgba(255,255,255,0.1);
        }

        input::placeholder { color: rgba(255,255,255,0.3); }
        input:disabled { opacity: 0.6; }

        .toggle-eye {
            position: absolute;
            right: 14px; top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.4);
            cursor: pointer;
            font-size: 0.9rem;
            transition: color 0.2s;
        }
        .toggle-eye:hover { color: #10b981; }

        .error-text { color: #f87171; font-size: 0.8rem; margin-top: 5px; }

        .strength-bar { height: 4px; border-radius: 2px; background: rgba(255,255,255,0.1); margin-top: 8px; overflow: hidden; }
        .strength-fill { height: 100%; width: 0; border-radius: 2px; transition: width 0.3s, background 0.3s; }
        .strength-label { font-size: 0.75rem; margin-top: 4px; color: rgba(255,255,255,0.4); }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #10b981, #059669);
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
            box-shadow: 0 8px 20px rgba(16,185,129,0.4);
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
    </style>
</head>
<body>
    <div class="card">
        <div class="icon-wrap">
            <i class="fas fa-lock-open"></i>
        </div>

        <h1>Reset Password</h1>
        <p class="subtitle">Enter your new password below. Choose something strong and memorable.</p>

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-circle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="error-text" style="margin-bottom:8px;"><i class="fas fa-circle-xmark"></i> {{ $error }}</div>
            @endforeach
        @endif

        <form action="{{ route('reset.password') }}" method="POST" id="resetForm">
            @csrf

            {{-- Hidden fields --}}
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" value="{{ $email }}" disabled>
            </div>

            <div class="form-group">
                <label>New Password</label>
                <div class="input-wrap">
                    <input type="password" name="password" id="password" placeholder="Enter new password" required>
                    <span class="toggle-eye" data-target="password"><i class="fas fa-eye"></i></span>
                </div>
                <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                <div class="strength-label" id="strengthLabel">Enter password to see strength</div>
            </div>

            <div class="form-group">
                <label>Confirm New Password</label>
                <div class="input-wrap">
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Re-enter new password" required>
                    <span class="toggle-eye" data-target="password_confirmation"><i class="fas fa-eye"></i></span>
                </div>
                <div class="error-text" id="matchError" style="display:none;"><i class="fas fa-circle-xmark"></i> Passwords do not match</div>
            </div>

            <button type="submit" class="btn-submit" id="resetBtn">
                <i class="fas fa-check-circle"></i> Reset Password
            </button>
        </form>

        <a href="{{ route('login') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Login
        </a>
    </div>

    <script>
        document.querySelectorAll('.toggle-eye').forEach(function(el) {
            el.addEventListener('click', function() {
                var target = this.getAttribute('data-target');
                var input  = document.getElementById(target);
                var icon   = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        });

        document.getElementById('password').addEventListener('input', function() {
            var val   = this.value;
            var fill  = document.getElementById('strengthFill');
            var label = document.getElementById('strengthLabel');
            var score = 0;

            if (val.length >= 6)  score++;
            if (val.length >= 10) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            var levels = [
                { pct: '20%',  bg: '#ef4444', text: 'Very Weak' },
                { pct: '40%',  bg: '#f97316', text: 'Weak' },
                { pct: '60%',  bg: '#eab308', text: 'Fair' },
                { pct: '80%',  bg: '#22c55e', text: 'Strong' },
                { pct: '100%', bg: '#10b981', text: 'Very Strong ✓' },
            ];

            if (val.length === 0) {
                fill.style.width  = '0';
                label.textContent = 'Enter password to see strength';
                label.style.color = 'rgba(255,255,255,0.4)';
            } else {
                var lvl = levels[score - 1] || levels[0];
                fill.style.width      = lvl.pct;
                fill.style.background = lvl.bg;
                label.textContent     = lvl.text;
                label.style.color     = lvl.bg;
            }
        });

        document.getElementById('resetForm').addEventListener('submit', function(e) {
            var pw  = document.getElementById('password').value;
            var cpw = document.getElementById('password_confirmation').value;
            var err = document.getElementById('matchError');

            if (pw !== cpw) {
                e.preventDefault();
                err.style.display = 'block';
            } else {
                err.style.display = 'none';
                document.getElementById('resetBtn').disabled = true;
                document.getElementById('resetBtn').innerHTML = '<i class="fas fa-spinner fa-spin"></i> Resetting...';
            }
        });

        document.getElementById('password_confirmation').addEventListener('input', function() {
            var pw  = document.getElementById('password').value;
            var err = document.getElementById('matchError');
            err.style.display = (this.value && this.value !== pw) ? 'block' : 'none';
        });
    </script>
</body>
</html>
