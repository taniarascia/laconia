<?php include __DIR__ . '/partials/header.php'; ?>

<?php include __DIR__ . '/partials/page-header.php'; ?>
    
    <section class="content-section">
        <div class="small-container">

           <?php if (!empty($this->lists)) : ?>
           <h2>Lists</h2>
            <p>Check out the lists <?= $this->user['username']; ?> made!</p>

            <div class="flex-grid">
                <?php foreach ($this->lists as $list) : ?>
                <div class="items">
                    <div class="list-item"><?= $list['title']; ?></div>
                    
                    <ul>
                    <?php foreach ($this->list->getListItemsByListId($list['id']) as $listItem) : ?>
                        <li><?= $listItem['name']; ?></li>
                    <?php endforeach; ?>
                    </ul>
                
                    
                </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php endif; ?>
        </div>
    </section>

<?php include __DIR__ . '/partials/footer.php'; ?>