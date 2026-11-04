<!DOCTYPE html>
<html>
<head>
    <title>EasyBuy - Login</title>
</head>
<body>
    <h2>Login to EasyBuy</h2>
    @if (session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Add this link right above the submit button -->
    <a href="/forgot-password">Forgot your password?</a><br><br>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf 

        <label>Email:</label><br>
        <input type="email" name="email" required value="{{ old('email') }}"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>