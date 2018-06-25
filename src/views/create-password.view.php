<?php include __DIR__ . '/partials/header.php'; ?>

    <div class="small-container">
        
        <h1><?= $this->page_title; ?></h1>
            
        <?php if (!empty($this->message)) : ?>
            <p><?= $this->message; ?>
        <?php endif; ?>

        <form action="" method="post">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <input type="submit" name="create" value="Create Password">
        </form>

    </div>

<?php include __DIR__ . '/partials/footer.php'; ?>