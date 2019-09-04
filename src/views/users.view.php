<?php include __DIR__ . '/partials/header.php'; ?>

<section class="content-section">
    <div class="container">
        <div class="card">
            <h1>Users</h1>
            <p>In a real application, it wouldn't really make sense to just list all your users. But for ease of testing, I made
                this page.</p>

            <?php foreach ($this->users as $user) : ?>
                <div class="listing">
                    <span><?= $user['id']; ?></span>
                    <a class="items list-item" href="/<?= strtolower($user['username']); ?>">
                        <?= $user['username']; ?>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>