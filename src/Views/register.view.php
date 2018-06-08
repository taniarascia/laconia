<?php include __DIR__ . '/partials/header.php'; ?>

    <h1><?= $page_title; ?></h1>
    
    <?php if ($message) : ?>
        <p><?= $message; ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password"><br>
        <label for="email">Email</label>
        <input type="email" id="email" name="email"><br>
        <input type="submit" name="register" value="Register"></button>
    </form>

    <a href="/">Home</a>  <a href="/login">Login</a>

<?php include __DIR__ . '/partials/footer.php'; ?>