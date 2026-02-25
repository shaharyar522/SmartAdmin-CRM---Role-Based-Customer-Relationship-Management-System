<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Your Password | SmartAdmin CRM</title>
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
            background: linear-gradient(135deg, #f59e0b, #d97706);
            display: flex; align-items: center; justify-content: center;
            font-size: 28px; color: #fff;
            margin: 0 auto 20px;
            box-shadow: 0 8px 20px rgba(245,158,11,0.4);
        }

        h1 {
            color: #fff;
            font-size: 1.6rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 8px;
        }

        .subtitle {
            color: rgba(255,255,255,0.55);
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .alert-info {
            background: rgba(245,158,11,0.15);
            border: 1px solid rgba(245,158,11,0.4);
            border-radius: 10px;
            padding: 14px 16px;
            color: #fbbf24;
            font-size: 0.85rem;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group { margin-bottom: 20px; }

        label {
            display: block;
            color: rgba(255,255,255,0.75);
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
        }

        input[type="password"], input[type="text"] {
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

        input:focus {
            border-color: #f59e0b;
            background: rgba(255,255,255,0.1);
        }

        input::placeholder { color: rgba(255,255,255,0.3); }

        .toggle-eye {
            position: absolute;
            right: 14px; top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.4);
            cursor: pointer;
            font-size: 0.9rem;
            transition: color 0.2s;
        }
        .toggle-eye:hover { color: #f59e0b; }

        .error-msg {
            color: #f87171;
            font-size: 0.8rem;
            margin-top: 5px;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(245,158,11,0.4);
        }

        .btn-submit:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

        .strength-bar {
            height: 4px;
            border-radius: 2px;
            background: rgba(255,255,255,0.1);
            margin-top: 8px;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            width: 0;
            border-radius: 2px;
            transition: width 0.3s, background 0.3s;
        }

        .strength-label {
            font-size: 0.75rem;
            margin-top: 4px;
            color: rgba(255,255,255,0.4);
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon-wrap">
            <i class="fas fa-key"></i>
        </div>

        <h1>Set Your Password</h1>
        <p class="subtitle">
            Welcome, <strong style="color:#fbbf24;">{{ Auth::user()->name }}</strong>!<br>
            Please create a strong permanent password.
        </p>

        <div class="alert-info">
            <i class="fas fa-shield-alt"></i>
            You are logged in with a <strong>temporary password</strong>. Set your own secure password to continue.
        </div>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="error-msg" style="margin-bottom:10px;"><i class="fas fa-circle-exclamation mr-1"></i> {{ $error }}</div>
            @endforeach
        @endif

        <form action="{{ route('set.password.update') }}" method="POST" id="setPasswordForm">
            @csrf

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
                <div class="error-msg" id="matchError" style="display:none;"><i class="fas fa-circle-xmark"></i> Passwords do not match</div>
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">
                <i class="fas fa-lock mr-1"></i> Save Password & Continue
            </button>
        </form>
    </div>

    <script>
        // Toggle password visibility
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

        // Password strength meter
        document.getElementById('password').addEventListener('input', function () {
            var val    = this.value;
            var fill   = document.getElementById('strengthFill');
            var label  = document.getElementById('strengthLabel');
            var score  = 0;

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
                { pct: '100%', bg: '#10b981', text: 'Very Strong' },
            ];

            if (val.length === 0) {
                fill.style.width = '0';
                label.textContent = 'Enter password to see strength';
                label.style.color = 'rgba(255,255,255,0.4)';
            } else {
                var lvl = levels[score - 1] || levels[0];
                fill.style.width      = lvl.pct;
                fill.style.background = lvl.bg;
                label.textContent     = '💪 ' + lvl.text;
                label.style.color     = lvl.bg;
            }
        });

        // Match check
        document.getElementById('setPasswordForm').addEventListener('submit', function(e) {
            var pw  = document.getElementById('password').value;
            var cpw = document.getElementById('password_confirmation').value;
            var err = document.getElementById('matchError');

            if (pw !== cpw) {
                e.preventDefault();
                err.style.display = 'block';
            } else {
                err.style.display = 'none';
                document.getElementById('submitBtn').disabled = true;
                document.getElementById('submitBtn').innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
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
