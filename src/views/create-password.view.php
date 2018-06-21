<?php include __DIR__ . '/partials/header.php'; ?>

    <h1><?= $this->page_title; ?></h1>
        
    <?php if ($this->message) : ?>
        <p><?= $this->message; ?>
    <?php endif; ?>

    <?php if (!$this->success) : ?>
    <form action="" method="post">
        <label for="password">Password</label>
        <input type="password" id="password" name="password"><br>
        <input type="submit" name="create" value="Create Password">
    </form>
    <?php endif; ?>

    <p><a href="/home">Home</a> </p>

<?php include __DIR__ . '/partials/footer.php'; ?>