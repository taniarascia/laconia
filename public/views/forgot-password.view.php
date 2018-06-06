<?php include __DIR__ . '/partials/header.php'; ?>

    <h1><?= $page_title; ?></h1>
        
        <?php if ($message) : ?>
            <p><?= $message; ?>
        <?php endif; ?>

        <form action="" method="post">
            <label for="email">Email</label>
            <input type="text" id="email" name="email"><br>
            <input type="submit" name="reset" value="Reset Password">
        </form>

    <a href="/">Home</a> <a href="/register">Register</a>

<?php include __DIR__ . '/partials/footer.php'; ?>