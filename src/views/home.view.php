<?php include __DIR__ . '/partials/header.php'; ?>

<?php include __DIR__ . '/partials/page-header.php'; ?>

    <section class="content-section">
        <div class="small-container">

            <h1><?= $this->page_title; ?></h1>

            <p>Welcome to Laconia, <?= $this->user['username']; ?>! This is your user panel. You can create a list, view and edit your lists, or change your settings.</p>
            
            <h2>My profile</h2>
            <p>View your public profile.</p>
            <p>
                <a class="button" href="/<?= strtolower($this->user['username']); ?>">View Profile</a>
            </p>
        </div>

        <?php if (!empty($this->lists)) : ?>
        
        <div class="small-container">

            <h2>My lists</h2>

            <?php include __DIR__ . '/partials/message.php'; ?>

            <div class="flex-list">

                <?php foreach ($this->lists as $list) : ?>
                <div class="items">
                    <div class="list-item"><?= $list['title']; ?></div>
                    <div class="list-options">
                        <a href="/edit/<?= $list['id']; ?>" class="button">Edit</a>
                        <form id="form-delete-list_<?= $list['id']; ?>">
                            <input type="hidden" name="delete" value="true">
                            <input type="hidden" name="list_id" value="<?= $list['id']; ?>">
                            <input type="submit" value="Delete">
                        </form>
                    </div>
                </div>
                <?php endforeach ?>
                
            </div>
        </div>

        <?php endif; ?>

    </section>

<?php include __DIR__ . '/partials/footer.php'; ?>