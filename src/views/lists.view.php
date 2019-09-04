<?php include __DIR__ . '/partials/header.php'; ?>

<section class="content-section">
    <div class="container">
        <h1 class="flex space-between align-center">Lists <a class="button accent-button" href="/create">Create</a></h1>

        <?php include __DIR__ . '/partials/message.php'; ?>
        <div class="flex-list">
            <?php if (!empty($this->lists)) : ?>

                <?php foreach ($this->lists as $list) : ?>
                    <div class="items card">
                        <div class="list-item">
                            <?= $list['title']; ?>
                        </div>
                        <div class="list-options">
                            <a class="button" href="/<?= strtolower($this->user['username']); ?>">View</a>
                            <a href="/edit/<?= $list['id']; ?>" class="button">Edit</a>
                            <form id="form-delete-list_<?= $list['id']; ?>">
                                <input name="csrf" type="hidden" value="<?= $this->csrf; ?>">
                                <input type="hidden" name="delete" value="true">
                                <input type="hidden" name="list_id" value="<?= $list['id']; ?>">
                                <input type="submit" value="Delete">
                            </form>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else : ?>
                <p>No lists to display. <a href="/create">Create a new list?</a></p>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>