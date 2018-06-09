<?php include __DIR__ . '/partials/header.php'; ?>

    <form method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password"><br>
        <input type="submit" name="login" value="Login">
    </form>

<a href="/">Home</a> <a href="/register">Register</a> <a href="/forgot-password">Forgot Password</a>

<?php include __DIR__ . '/partials/footer.php'; ?>