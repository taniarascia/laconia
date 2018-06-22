<?php include __DIR__ . '/partials/header.php'; ?>

    <h1><?= $this->page_title; ?></h1>

    <h2>All Users</h2>

    <ul>
    <?php foreach ($this->users as $user) : ?>

        <li><a href="/<?= $user['username']; ?>"><?= $user['username']; ?></a></li>
 
    <?php endforeach ?>
    </ul>

    <p><a href="/">Index</a> <a href="/logout">Logout</a></p>

<?php include __DIR__ . '/partials/footer.php'; ?>