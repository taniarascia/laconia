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
        <div id="list-items">
            <label>List</label><br>
            <input type="text" name="0" value="Start typing..."><br>
        </div>
        <input type="submit">
    </form>

    <a href="/home">Home</a>

<?php include __DIR__ . '/partials/footer.php'; ?>