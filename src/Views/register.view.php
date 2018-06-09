<?php include __DIR__ . '/partials/header.php'; ?>

    <form method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username"/><br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password"/><br>
        <label for="email">Email</label>
        <input type="email" id="email" name="email"/><br>
        <input type="submit" name="register" value="Register"/>
    </form>

    <a href="/">Home</a>
	<a href="/login">Login</a>

<?php include __DIR__ . '/partials/footer.php'; ?>