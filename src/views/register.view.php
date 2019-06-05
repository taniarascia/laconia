<?php include __DIR__ . '/partials/header.php'; ?>

<section class="content-section">
    <div class="form-container">
        <div class="card">
            <form id="form-register">
                <h3>Sign up for Laconia</h3>

                <p>This website is a demo. You're not signing up for any product, just testing out the front end of Laconia. Your password is securely encrypted, and you can fully delete all your information at any time.</p>

                <input name="csrf" type="hidden" value="<?= $this->csrf; ?>">
                <label for="username">Username</label>
                <input type="text" id="username" name="username">

                <label for="password">Password</label>
                <input type="password" id="password" name="password">

                <label for="email">Email</label>
                <input type="email" id="email" name="email">
                <small>You can register with a fake email.</small>

                <div class="actions">
                    <?php include __DIR__ . '/partials/message.php'; ?>
                    <input type="submit" value="Register">
                </div>
            </form>
        </div>
    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>