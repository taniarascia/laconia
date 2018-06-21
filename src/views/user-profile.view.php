<?php include __DIR__ . '/partials/header.php'; ?>

    <h1><?= $this->page_title; ?></h1>

    <h2><?= $this->user['username']; ?></h2>

    <p><a href="/home">Home</a> <a href="/register">Register</a> <a href="/login">Login</a> <a href="/logout">Logout</a> <a href="/forgot-password">Forgot Password</a></p>

<?php include __DIR__ . '/partials/footer.php'; ?>