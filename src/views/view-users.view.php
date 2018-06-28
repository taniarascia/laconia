<?php include __DIR__ . '/partials/header.php'; ?>

<?php include __DIR__ . '/partials/page-header.php'; ?>

    <section class="content-section">
        <div class="small-container">
            
            <h1>View all users</h1>
            <p>In a real application, it wouldn't really make sense to just list all your users. But for ease of testing, I made this page.</p>
            
            <?php foreach ($this->users as $user) : ?>
            <div class="comments">
                <a class="items list-item" href="/<?= strtolower($user['username']); ?>"><?= $user['username']; ?></a>
            </div>
            <?php endforeach ?>

        </div>
    </section>

<?php include __DIR__ . '/partials/footer.php'; ?>