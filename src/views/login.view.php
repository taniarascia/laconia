<?php include __DIR__ . '/partials/header.php'; ?>

<?php include __DIR__ . '/partials/page-header.php'; ?>

<section class="content-section">
    <div class="small-container">

        <h1>
            <?= $this->page_title; ?>
        </h1>
        <p>Thanks for coming back!</p>

        <?php include __DIR__ . '/partials/message.php'; ?>

        <form id="form-login">
            <label for="username">Username</label>
            <input type="text" id="username" name="username">

            <label for="password">Password</label>
            <input type="password" id="password" name="password">

            <input type="submit" value="Login">
            <a class="button" href="/forgot-password">Forgot Password?</a>
        </form>

    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>