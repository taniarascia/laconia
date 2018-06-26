<?php include __DIR__ . '/partials/header.php'; ?>

<?php include __DIR__ . '/partials/page-header.php'; ?>

    <section class="content-section">
        <div class="tiny-container">

            <h2>Forgot your password?</h2>
            <p>Enter the email address you signed up with and we'll email you a link to reset your password. Or, we would, but I haven't coded that yet.</p>

            <?php include __DIR__ . '/partials/message.php'; ?>

            <form id="form-forgot-password" action="" method="post">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">

                <input type="submit" name="reset" value="Reset Password">
            </form>
        </div>
    </section>
    
<?php include __DIR__ . '/partials/footer.php'; ?>