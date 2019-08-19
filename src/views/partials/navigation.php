<div class="navigation-outer">
    <section class="navigation">
        <div class="navigation-brand">
            <a href="/">
                <img src="<?= $this->getImage('amphora.png'); ?>" class="logo">
                <span>
                    <?= SITE_NAME; ?>
                </span>
            </a>
        </div>
        <div class="navigation-links">

            <?php if ($this->session->isUserLoggedIn()) : ?>
                <a href="/dashboard">Dashboard</a>
                <a href="/<?= $this->user['username']; ?>">Profile</a>
                <a href="/lists">Lists</a>
                <a href="/settings">Settings</a>
                <a href="/logout" class="button">Logout</a>
            <?php else : ?>
                <a href="https://github.com/taniarascia/laconia" target="_blank">Source</a>
                <a href="/login">Log In</a>
                <a href="/register" class="button">Register</a>
            <?php endif; ?>

        </div>
    </section>
</div>