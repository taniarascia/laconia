<?php include __DIR__ . '/partials/header.php'; ?>

<?php include __DIR__ . '/partials/page-header.php'; ?>

    <section class="content-section">
        <div class="small-container">
            <h1>View all users</h1>
            <p>In a real application, it wouldn't really make sense to just list all your users. But for ease of testing, I made this page.</p>
            
            <ul>
            <?php foreach ($this->users as $user) : ?>
                <li><a href="/<?= $user['username']; ?>"><?= $user['username']; ?></a></li>
            <?php endforeach ?>
            </ul>
        </div>
    </section>

<?php include __DIR__ . '/partials/footer.php'; ?>