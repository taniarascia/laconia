<?php include __DIR__ . '/partials/header.php'; ?>

    <h1><?= $this->page_title; ?></h1>
        
    <?php if ($this->message) : ?>
        <p><?= $this->message; ?>
    <?php endif; ?>

    <form action="" method="post">
        <label for="password">Password</label>
        <input type="text" id="password" name="password"><br>
        <input type="submit" name="create" value="Create Password">
    </form>

    <a href="/home">Home</a> 

<?php include __DIR__ . '/partials/footer.php'; ?>