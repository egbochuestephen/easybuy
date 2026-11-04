<!DOCTYPE html>
<html>
<head>
    <title>EasyBuy - Register</title>
</head>
<body>
    <h2>Register for EasyBuy</h2>
    
    <!-- This block shows any validation errors (like a password being too short) -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/register">
        <!-- @csrf is a mandatory Laravel security token to prevent hacking -->
        @csrf 
        
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Password (Min 8 characters):</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Register</button>
    </form>
</body>
</html>