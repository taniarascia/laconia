<?php include __DIR__ . '/partials/header.php'; ?>

<?php include __DIR__ . '/partials/page-header.php'; ?>

<section class="content-section">
    <div class="small-container">

        <h1>
            <?= $this->pageTitle; ?>
        </h1>
        <p>Enter the email address you signed up with and we'll email you a link to reset your password. (Actually, I'll just paste a URL here since mail is tricky and annoying)</p>

        <?php include __DIR__ . '/partials/message.php'; ?>

        <form id="form-forgot-password">
            <input name="csrf" type="hidden" value="<?= $this->csrf; ?>">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">

            <input type="submit" value="Reset Password">
        </form>

    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>