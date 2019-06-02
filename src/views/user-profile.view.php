<?php include __DIR__ . '/partials/header.php'; ?>

<section class="content-section content-accent">
    <div class="small-container text-center">
        <h1>
            <?= $this->user['username']; ?>
        </h1>

        <?php if (!empty($this->user['description'])) : ?>
            <?= $this->user['description']; ?>
        <?php endif; ?>

        <?php if (empty($this->user['description'])) : ?>
            <div> Welcome to the <?= $this->user['username']; ?>'s public Laconia page! <?= $this->user['username']; ?> has not written a description yet. Please check back later.</div>
        <?php endif; ?>
    </div>
</section>

<section class="content-section">
    <div class="container">

        <?php if (!empty($this->lists)) : ?>
            <div class="flex-grid">
                <?php foreach ($this->lists as $list) : ?>
                    <div class="card lists">
                        <h3 class="list-title">
                            <?= $list['title']; ?>
                        </h3>

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
        <?php else : ?>
            <div class="card text-center">
                <h3 class="no-margin-bottom"><?= $this->user['username']; ?> hasn't made any lists yet.</h3>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>