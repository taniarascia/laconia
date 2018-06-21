<?php include __DIR__ . '/partials/header.php'; ?>
    
    <h1><?= $this->page_title; ?></h1>

        <ul>
        <?php foreach ($this->editList as $list) : ?>

            <li><?= $list['name']; ?></a></li> 

        <?php endforeach ?>
        </ul>
    
    <p><a href="/home">Home</a></p>

<?php include __DIR__ . '/partials/footer.php'; ?>