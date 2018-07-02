<?php include __DIR__ . '/partials/header.php'; ?>

<?php include __DIR__ . '/partials/page-header.php'; ?>

<section class="content-section">
    <div class="small-container">

        <h1>
            <?= $this->pageTitle; ?>
        </h1>

        <?php include __DIR__ . '/partials/message.php'; ?>

        <form id="form-edit-list">
            <input name="csrf" type="hidden" value="<?= $this->csrf; ?>">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="<?= $this->listTitle['title']; ?>">

            <label for="list-items">List items</label>
            <div id="list-items">
                
                <?php foreach ($this->editList as $list) : ?>
                    <div class="input-group" id="first-group">
                        <input type="text" name="<?= $list['id']; ?>" value="<?= $list['name']; ?>">
                    </div>
                <?php endforeach ?>

            </div>

            <input type="submit" value="Update">
        </form>

    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>