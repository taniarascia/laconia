<?php include __DIR__ . '/partials/header.php'; ?>

<?php include __DIR__ . '/partials/page-header.php'; ?>

<section class="content-section">
    <div class="small-container">

        <h1>Welcome to Laconia</h1>
        <p class="lead">An MVC PHP Application without libraries or frameworks.</p>

        <p>Laconia is a personal project created by
            <a href="https://www.taniarascia.com">Tania Rascia</a> to learn the fundamentals of programming and modern web development from scratch. The main goals
            of the project are to learn MVC (Model View Controller) architecture, the OOP (Object-Oriented Programming) paradigm,
            routing, modern development practices, and how to tie it all together to make a functional web app.</p>

        <p>Please feel free to fork, use, comment, critique, suggest, improve or help in any way.</p>

        <p>
            <a class="button" href="/view-users">View Users</a>
        </p>

        <h2>Comments</h2>

        <?php if (!$this->comments) : ?>
        <p>No comments yet! Sign in to leave a comment.</p>
        <?php else : ?>

        <div id="comments">
            <?php foreach ($this->comments as $comment) : ?>
            <div class="comments">
                <a class="items list-item" href="/<?= strtolower($comment['username']); ?>"><?= $comment['username']; ?></a>
                <p><?= $comment['comment']; ?></p>
            </div>
            <?php endforeach ?>
        </div>


        <?php endif; ?>

        <?php if ($this->isLoggedIn) : ?>
        <h3>Leave a comment</h3>
        <?php include __DIR__ . '/partials/message.php'; ?>

        <form id="form-comments">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= $this->user['username']; ?>" readonly>

            <label for="comment">Comment</label>
            <textarea name="comment" id="comment" cols="30" rows="10"></textarea>

            <input type="submit" value="Submit">
        </form>
        <?php endif; ?>

    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>