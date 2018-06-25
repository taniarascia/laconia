<?php include __DIR__ . '/partials/header.php'; ?>

    <div class="small-container">
    
        <h1><?= $this->page_title; ?></h1>
            
        <?php if (!empty($this->message)) : ?>
            <p><?= $this->message; ?>
        <?php endif; ?>

        <form action="" method="post">
            <label for="email">Email</label>
            <input type="text" id="email" name="email">
            <input type="submit" name="reset" value="Reset Password">
        </form>
    
    </div>

<?php include __DIR__ . '/partials/footer.php'; ?>