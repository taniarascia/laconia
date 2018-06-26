<?php include __DIR__ . '/partials/header.php'; ?>

<?php include __DIR__ . '/partials/page-header.php'; ?>
    
    <section class="content-section">
        <div class="tiny-container">

        <h2>Sign in</h2>
        <p>Thanks for coming back! You'll get a 20% discount off all future logins for being such a valuable user.</p>    

        <?php include __DIR__ . '/partials/message.php'; ?>

            <form action="" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <input type="submit" name="login" value="Login">
            </form>
        </div>
    </section>

<?php include __DIR__ . '/partials/footer.php'; ?>