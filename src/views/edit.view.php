<?php include __DIR__ . '/partials/header.php'; ?>

<?php include __DIR__ . '/partials/page-header.php'; ?>

    <section class="content-section">
        <div class="small-container">

            <?php include __DIR__ . '/partials/message.php'; ?>

            <form id="form-edit-list" action="" method="post">

                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?= $this->listTitle['title']; ?>">
            
                <label>List items</label>
                <?php foreach ($this->editList as $list) : ?>
                    <input type="text" name="<?= $list['id']; ?>" value="<?= $list['name']; ?>">
                <?php endforeach ?>

                <input type="submit" value="Update"> <a class="button" href="/home">Back</a>
            
            </form>
        </div>
    </section>

<?php include __DIR__ . '/partials/footer.php'; ?>