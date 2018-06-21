<?php include __DIR__ . '/partials/header.php'; ?>

    <h1><?= $this->page_title; ?></h1>
        
    <?php if ($this->message) : ?>
        <p><?= $this->message; ?>
    <?php endif; ?>

    <form action="" method="post">
        <label for="email">Email</label>
        <input type="text" id="email" name="email"><br>
        <input type="submit" name="reset" value="Reset Password">
    </form>

    <p><a href="/">Home</a> <a href="/register">Register</a></p>

<?php include __DIR__ . '/partials/footer.php'; ?>