<!DOCTYPE html>
<html>
<head>
    <title>EasyBuy - Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <p>Enter your email address and we will send you a 6-digit reset code.</p>
    
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/forgot-password">
        @csrf 
        
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <button type="submit">Send OTP</button>
    </form>
</body>
</html>