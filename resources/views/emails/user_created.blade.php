<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { width: 80%; margin: 20px auto; border: 1px solid #ddd; border-radius: 8px; padding: 20px; background-color: #f9f9f9; }
        .header { text-align: center; border-bottom: 2px solid #007bff; padding-bottom: 20px; }
        .content { padding: 20px 0; }
        .details { background-color: #fff; border: 1px dashed #007bff; padding: 15px; border-radius: 5px; margin: 20px 0; }
        .footer { text-align: center; font-size: 0.9em; color: #777; margin-top: 20px; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #007bff; color: white !important; text-decoration: none; border-radius: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="color: #007bff;">Welcome to SmartAdmin CRM</h2>
        </div>
        <div class="content">
            <p>Hello <strong>{{ $user->name }}</strong>,</p>
            <p>Your account has been successfully created by the Administrator. You can now log in to the system using the following credentials:</p>
            
            <div class="details">
                <p><strong>Login URL:</strong> <a href="{{ config('app.url') }}/login">{{ config('app.url') }}/login</a></p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Temporary Password:</strong> <span style="font-family: monospace; font-size: 1.2em; color: #d9534f;">{{ $password }}</span></p>
            </div>

            <p style="color: #856404; background-color: #fff3cd; padding: 10px; border-radius: 5px;">
                <strong>Security Notice:</strong> For your security, we recommend changing your password after your first login through the Profile section.
            </p>

            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ url('/login') }}" class="btn">Login to Dashboard</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} SmartAdmin-CRM. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
