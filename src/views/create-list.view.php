<?php include __DIR__ . '/partials/header.php'; ?>
    
    <h1><?= $this->page_title; ?></h1>

    <?php if ($this->message) : ?>
        <p><?= $this->message; ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <label>Title</label>
        <input type="text" name="title">
        <label>List</label>
        <div id="list-items">
            <input type="text" name="list_item_0">
        </div>
        <input type="submit">
    </form>

    <p><a href="/home">Home</a><p>

<?php include __DIR__ . '/partials/footer.php'; ?>