<?php include __DIR__ . '/partials/header.php'; ?>

<section class="content-section">
    <div class="form-container">
        <div class="card">
            <form id="form-login">
                <h3>Welcome back!</h3>

                <p>Sign in with your username and password. Don't have an account? <a href="/register">Register here</a>.</p>

                <input name="csrf" type="hidden" value="<?= $this->csrf; ?>">
                <label for="username">Username</label>
                <input type="text" id="username" name="username">

                <label for="password">Password</label>
                <input type="password" id="password" name="password">

                <div class="actions">
                    <?php include __DIR__ . '/partials/message.php'; ?>
                    <input type="submit" class="accent-button" value="Log In">
                    <a class="button" href="/forgot-password">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>