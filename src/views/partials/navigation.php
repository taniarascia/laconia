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
            <?php if ($this->session->isUserLoggedIn()) : ?>
                <a href="/home">Home</a>
                <a href="/create-list">Create List</a>
                <a href="/logout">Logout</a>
            <?php else : ?>
                <a href="/login" class="button">Login</a>
                <a href="/register" class="button">Register</a>
            <?php endif; ?>
        </div>
    </section>
</div>