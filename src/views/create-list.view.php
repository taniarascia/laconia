<?php include __DIR__ . '/partials/header.php'; ?>

    <h1><?= $this->page_title; ?></h1>

    <?php if ($this->message) : ?>
        <p><?= $this->message; ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <div>
            <label>Title</label><br>
            <input type="text" name="title">
        </div>
        <div>
            <label>List</label><br>
            <input type="text" name="list_item_1" value="1"><br>
            <input type="text" name="list_item_2" value="2">
        </div>
        <input type="submit">
    </form>

    <a href="/home">Home</a>

<?php include __DIR__ . '/partials/footer.php'; ?>