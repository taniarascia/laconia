<?php include __DIR__ . '/partials/header.php'; ?>

<?php include __DIR__ . '/partials/page-header.php'; ?>

    <section class="content-section">
        <div class="small-container">

            <h2>Create a list</h2>
            <p>Press <kbd>SHIFT</kbd> + <kbd>ENTER</kbd> to add a new list item.</p>

            <?php include __DIR__ . '/partials/message.php'; ?>

            <form id="form-create-list" action="" method="post">
                <label for="title">Title</label>
                <input type="text" name="title" id="title">
                
                <label>List items</label>
                <div id="list-items">
                    <input type="text" id="0" name="list_item_0">
                </div>

                <input type="submit" value="Create">
                <a href="/home" class="button">Back</a>
            </form>
        </div>
    </section>

<?php include __DIR__ . '/partials/footer.php'; ?>