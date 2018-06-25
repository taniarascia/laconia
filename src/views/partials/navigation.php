<div class="navigation-outer">
    <section class="navigation">
        <div class="navigation-brand">
            <a href="/">
                <span>
                    <?= SITE_NAME; ?>
                </span>
            </a>
        </div>
        <div class="navigation-links">
            <a href="/view-users">View Users</a>
            <?php if ($this->session->isUserLoggedIn()) : ?>
                <a href="/home">Home</a>
                <a href="/logout">Logout</a>
            <?php else : ?>
                <a href="/login">Login</a>
                <a href="/register">Register</a>
                <a href="/forgot-password">Forgot Password</a>
            <?php endif; ?>
        </div>
    </section>
</div>