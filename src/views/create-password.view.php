<?php include __DIR__ . '/partials/header.php'; ?>

    <h1><?= $this->page_title; ?></h1>
        
    <?php if (!empty($this->message)) : ?>
        <p><?= $this->message; ?>
    <?php endif; ?>

    <form action="" method="post">
        <label for="password">Password</label>
        <input type="password" id="password" name="password"><br>
        <input type="submit" name="create" value="Create Password">
    </form>

    <p><a href="/home">Home</a> </p>

<?php include __DIR__ . '/partials/footer.php'; ?>