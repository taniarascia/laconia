<?php include __DIR__ . '/partials/header.php'; ?>

    <div class="small-container">
        
        <h1><?= $this->user['username']; ?></h1>

        <h2>Lists</h2>

        <ul>
        <?php foreach ($this->lists as $list) : ?>
            <li><a href="<?= $this->user['username']; ?>/list/<?= $list['id']; ?>"><?= $list['title']; ?></a></li>
        <?php endforeach ?>
        </ul>
        
    </div>

<?php include __DIR__ . '/partials/footer.php'; ?>