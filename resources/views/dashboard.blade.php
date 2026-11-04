<!DOCTYPE html>
<html>
<head>
    <title>EasyBuy - Dashboard</title>
</head>
<body>
    <!-- Auth::user()->name dynamically pulls the logged-in user's name -->
    <h2>Welcome to your Dashboard, {{ Auth::user()->name }}!</h2>
    <p>You are successfully logged in.</p>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>