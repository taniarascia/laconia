<?php include __DIR__ . '/partials/header.php'; ?>

<section class="content-section">
    <div class="container">
        <div class="flex-row">
            <div class="flex-large">
                <div class="card">
                    <h1>
                        <?= $this->pageTitle; ?>
                    </h1>

                    <p>Welcome to your settings page. Here you can update your email address and other information on your profile. Your profile will be <a href="/<?= strtolower($this->user['username']); ?>">publicly visible here</a>.</p>

                    <?php include __DIR__ . '/partials/message.php'; ?>

                    <form id="form-settings">
                        <input name="csrf" type="hidden" value="<?= $this->csrf; ?>">

                        <label for="email">Username</label>
                        <input readonly type="text" value="<?= $this->user['username']; ?>">
                        <small>Username cannot be changed.</small>

                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?= $this->user['email']; ?>">

                        <label for="fullname">Name</label>
                        <input type="text" name="fullname" id="fullname" value="<?= $this->user['fullname']; ?>">

                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" value="<?= $this->user['location']; ?>">

                        <label for="description">About</label>
                        <textarea name="description" id="description" cols="30" rows="5"><?= $this->user['description']; ?></textarea>

                        <input type="submit" value="Update">
                    </form>
                </div>
            </div>
            <div class="flex-large">
                <div class="card solo">
                    <h2>Delete account</h2>
                    <p>Warning! There is no undoing this action! All of your user data and associated list data will be permanently removed
                        from the database.</p>

                    <form id="form-delete-user">
                        <input name="csrf" type="hidden" value="<?= $this->csrf; ?>">
                        <input type="hidden" name="delete_user" value="true">
                        <input type="hidden" name="list_id" value="<?= $this->user['id']; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>