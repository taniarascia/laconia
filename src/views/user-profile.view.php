<?php include __DIR__ . '/partials/header.php'; ?>

<?php include __DIR__ . '/partials/page-header.php'; ?>
    
    <section class="content-section">
        <div class="small-container">

        <h2><?= $this->user['username']; ?></h2>
        
        <?php if ($this->user['description']) : ?>
            <p><?= $this->user['description']; ?></p>
        <?php endif; ?>
        
        <?php if ($this->user['location']) : ?>
            <h4>Location</h4>
            <p><?= $this->user['location']; ?></p>
        <?php endif; ?>
        
        <?php if ($this->user['email']) : ?>
            <h4>Contact</h4>
            <p><a href="mailto:<?= $this->user['email']; ?>"><?= $this->user['email']; ?></a></p>
        <?php endif; ?>
        
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
        <?php endif; ?>

        </div>
    </section>

<?php include __DIR__ . '/partials/footer.php'; ?>