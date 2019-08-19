<?php include __DIR__ . '/partials/header.php'; ?>

<section class="content-section">
    <div class="small-container">
        <div class="card">
            <h1>
                <?= $this->pageTitle; ?>
            </h1>
            <p>Create your list! A list is simply a title and some associated entries. Lists are visible on <a href="/<?= strtolower($this->user['username']); ?>">your profile</a>.</p>

            <?php include __DIR__ . '/partials/message.php'; ?>

            <form id="form-create-list">
                <input name="csrf" type="hidden" value="<?= $this->csrf; ?>">
                <label for="title">Title</label>
                <input type="text" name="title" id="title">

                <label for="list-items">List items</label>
                <div id="list-items">

                    <?php for ($i = 0; $i < 3; $i++) : ?>
                        <div class="input-group" id="first-group">
                            <input type="text" id="<?= $i; ?>" name="list_item_<?= $i; ?>">
                        </div>
                    <?php endfor; ?>

                </div>

                <div class="actions">
                    <input type="submit" value="Create">
                    <a class="button accent-button" href="/lists">Back to Lists</a>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>