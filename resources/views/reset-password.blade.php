<!DOCTYPE html>
<html>
<head>
    <title>EasyBuy - Reset Password</title>
</head>
<body>
    <h2>Enter Reset Code</h2>
    
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/reset-password">
        @csrf 
        
        <!-- We auto-fill the email if it was passed from the previous step -->
        <label>Email:</label><br>
        <input type="email" name="email" value="{{ $email ?? old('email') }}" required><br><br>
        
        <label>6-Digit OTP:</label><br>
        <input type="text" name="otp" required maxlength="6"><br><br>

        <label>New Password (Min 8 characters):</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>