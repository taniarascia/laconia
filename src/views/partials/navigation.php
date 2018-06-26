<div class="navigation-outer">
    <section class="navigation">
        <div class="navigation-brand">
            <a href="/">
                <span>
                <i class="fas fa-sun"></i>
                    <?= SITE_NAME; ?>
                </span>
            </a>
        </div>
        <div class="navigation-links">
            <?php if ($this->session->isUserLoggedIn()) : ?>
                <a href="/home">Home</a>
                <a href="/create">Create List</a>
                <a href="/settings">Settings</a>
                <a href="/logout" class="button">Logout</a>
            <?php else : ?>
                <a href="/login" class="button">Login</a>
                <a href="/register" class="button">Register</a>
            <?php endif; ?>
        </div>
    </section>
</div>
<div class="pattern-border"></div>