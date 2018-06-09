<?php include __DIR__ . '/partials/header.php'; ?>

<div><h2>Hello, <?= $_SESSION['username']; ?>!</h2></div>

<div><a href="/logout">Logout</a></div>

<?php include __DIR__ . '/partials/footer.php'; ?>