<?php include __DIR__ . '/partials/header.php'; ?>

<section class="content-section content-accent">
    <div class="small-container text-center">
        <h1>
            Welcome to Laconia
        </h1>

        <p>Welcome to Laconia,
            <?= $this->user['username']; ?>! This is your user dashboard. As a logged in user, you now have a public profile which will display your user details, and any lists you create. Lists are a simple CRUD example of something a user can create. From the settings page, you can update your data or delete your account.</p>
    </div>
</section>
<section class="content-section">
    <div class="container">
        <div class="flex-row">
            <div class="flex-small">
                <div class="card text-center">
                    <h3>My profile</h3>
                    <p>View your public profile.</p>
                    <a class="button" href="/<?= strtolower($this->user['username']); ?>">View Profile</a>
                </div>
            </div>
            <div class="flex-small">
                <div class="card text-center">
                    <h3>My settings</h3>
                    <p>Update your settings.</p>
                    <a class="button" href="/settings">Update Settings</a>
                </div>
            </div>
            <div class="flex-small">
                <div class="card text-center">
                    <h3>My lists</h3>
                    <p>View, create, edit, delete lists.</p>
                    <a class="button" href="/lists">Go to Lists</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>