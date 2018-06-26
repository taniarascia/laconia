<?php include __DIR__ . '/partials/header.php'; ?>

<?php include __DIR__ . '/partials/page-header.php'; ?>

    <section class="content-section">
        <div class="tiny-container">
            <h2><?= $this->listTitle['title']; ?></h2>

            <?php include __DIR__ . '/partials/message.php'; ?>

            <form action="" method="post">
            <?php foreach ($this->editList as $list) : ?>
                <input type="text" name="<?= $list['id']; ?>" value="<?= $list['name']; ?>">
            <?php endforeach ?>
            <input type="submit" value="Update"> <a class="button" href="/home">Back</a>
            
            </form>
        </div>
    </section>

<?php include __DIR__ . '/partials/footer.php'; ?>