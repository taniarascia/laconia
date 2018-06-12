<?php include __DIR__ . '/partials/header.php'; ?>

    <h1><?= $this->page_title; ?></h1>

    <?php if ($this->message) : ?>
        <p><?= $this->message; ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password"><br>
        <input type="submit" name="login" value="Login">
    </form>

    <a href="/">Home</a> <a href="/register">Register</a> <a href="/forgot-password">Forgot Password</a>

<?php include __DIR__ . '/partials/footer.php'; ?>