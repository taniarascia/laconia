<?php include __DIR__ . '/partials/header.php'; ?>
    
    <div class="small-container">
        
        <h1><?= $this->page_title; ?></h1>

            <ul>
            <?php foreach ($this->editList as $list) : ?>

                <li><?= $list['name']; ?></a></li> 

            <?php endforeach ?>
            </ul>
        
    </div>

<?php include __DIR__ . '/partials/footer.php'; ?>