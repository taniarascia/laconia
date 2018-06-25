<?php include __DIR__ . '/partials/header.php'; ?>
    
    <div class="small-container">

        <h1><?= $this->page_title; ?></h1>
        <h2><?= $this->listTitle['title']; ?></h2>

        <?php if (!empty($this->message)) : ?>
            <p><?= $this->message; ?>
        <?php endif; ?>

            <form action="" method="post">
            
            <?php foreach ($this->editList as $list) : ?>

                <input type="text" name="<?= $list['id']; ?>" value="<?= $list['name']; ?>">

            <?php endforeach ?>

            <input type="submit" value="Update"> <a class="button" href="/home">Back</a>
            
            </form>

        
    </div>

<?php include __DIR__ . '/partials/footer.php'; ?>