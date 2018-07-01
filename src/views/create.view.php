<?php include __DIR__ . '/partials/header.php'; ?>

<?php include __DIR__ . '/partials/page-header.php'; ?>

<section class="content-section">
    <div class="small-container">

        <h1>
            <?= $this->pageTitle; ?>
        </h1>
        <p>Create your top five list!</p>

        <?php include __DIR__ . '/partials/message.php'; ?>

        <form id="form-create-list">
            <label for="title">Title</label>
            <input type="text" name="title" id="title">

            <label for="list-items">List items</label>
            <div id="list-items">
            <?php for ($i = 0; $i < 5; $i++) : ?>
                <div class="input-group" id="first-group">
                    <input type="text" id="<?= $i; ?>" name="list_item_<?= $i; ?>">
                </div>
            <?php endfor; ?>
            </div>

            <input type="submit" value="Create">
        </form>

    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>