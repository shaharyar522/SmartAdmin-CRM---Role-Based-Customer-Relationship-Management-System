<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { width: 80%; margin: 20px auto; border: 1px solid #ddd; border-radius: 8px; padding: 20px; background-color: #f9f9f9; }
        .header { text-align: center; border-bottom: 2px solid #6366f1; padding-bottom: 20px; }
        .content { padding: 20px 0; }
        .footer { text-align: center; font-size: 0.9em; color: #777; margin-top: 20px; }
        .btn { display: inline-block; padding: 14px 28px; background-color: #6366f1; color: white !important; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 1rem; }
        .warning { background-color: #fff3cd; border: 1px solid #ffc107; padding: 12px; border-radius: 6px; margin-top: 20px; color: #856404; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="color: #6366f1;">🔐 SmartAdmin CRM</h2>
            <p style="color: #555; margin: 0;">Password Reset Request</p>
        </div>

        <div class="content">
            <p>Hello <strong>{{ $user->name }}</strong>,</p>
            <p>We received a request to reset the password for your SmartAdmin CRM account. Click the button below to set a new password:</p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ $resetUrl }}" class="btn">Reset My Password</a>
            </div>

            <p>Or copy and paste this link into your browser:</p>
            <p style="word-break: break-all; background: #f0f0f0; padding: 10px; border-radius: 5px; font-size: 0.85em;">
                <a href="{{ $resetUrl }}">{{ $resetUrl }}</a>
            </p>

            <div class="warning">
                <strong>⚠️ Important:</strong>
                <ul style="margin: 5px 0 0 15px;">
                    <li>This link will <strong>expire in 60 minutes</strong>.</li>
                    <li>If you did not request a password reset, please ignore this email — your account is safe.</li>
                </ul>
            </div>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} SmartAdmin-CRM. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
