<?php include __DIR__ . '/partials/header.php'; ?>

<?php include __DIR__ . '/partials/page-header.php'; ?>

<section class="content-section">
    <div class="small-container">

        <h1>
            <?= $this->user['username']; ?>
        </h1>
        <?php if (!empty($this->user['fullname'])) : ?>
        <div>
            <strong>Full Name</strong>:
            <?= $this->user['fullname']; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($this->user['description'])) : ?>
        <div>
            <strong>About</strong>:
            <?= $this->user['description']; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($this->user['location'])) : ?>
        <div>
            <strong>Location</strong>:
            <?= $this->user['location']; ?>
        </div>
        <?php endif; ?>

    </div>

    <div class="small-container">

        <?php if (!empty($this->lists)) : ?>
        <h2>Lists</h2>
        <p>Check out the lists
            <?= $this->user['username']; ?> made!</p>

        <div class="flex-grid">
            <?php foreach ($this->lists as $list) : ?>
            <div class="items">
                <div class="list-title">
                    <?= $list['title']; ?>
                </div>

                <div class="list-items">
                    <ul>
                        <?php foreach ($this->list->getListItemsByListId($list['id']) as $listItem) : ?>
                        <li>
                            <?= $listItem['name']; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>
            <?php endforeach ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>