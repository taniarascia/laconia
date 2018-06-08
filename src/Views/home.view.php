<?php include __DIR__ . '/partials/header.php'; ?>

<h1><?= $page_title; ?></h1>

<h2><?= $row['username']; ?></h2>

<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
    </tr>

    <tr>
        <td><?= $row['username']; ?></td>
        <td><?= $row['email']; ?></td>
    </tr>

</table>

<a href="/logout">Logout</a>

<?php include __DIR__ . '/partials/footer.php'; ?>