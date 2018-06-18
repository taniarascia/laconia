<?php include __DIR__ . '/partials/header.php'; ?>

    <h1><?= $this->page_title; ?></h1>

    <h2><?= $this->user['username']; ?></h2>

    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
        </tr>

        <tr>
            <td><?= $this->user['username']; ?></td>
            <td><?= $this->user['email']; ?></td>
        </tr>

    </table>

    <h2>My lists</h2>

    <ul>
    <?php foreach ($this->lists as $list) : ?>

        <li><a href="/edit-list/<?= $list['id']; ?>"><?= $list['title']; ?></a></li>

    <?php endforeach ?>
    </ul>

    <h2>Create a list</h2>

    <p><a href="/create-list">Create</a></p>

    <p><a href="/">Index</a> <a href="/logout">Logout</a></p>

<?php include __DIR__ . '/partials/footer.php'; ?>