<?php include __DIR__ . '/partials/header.php'; ?>

    <div class="small-container">

        <h1><?= SITE_NAME; ?></h1>
        <p class="lead">An MVC application written in plain PHP without libraries or frameworks</p>

        <p>Welcome to Laconia.</p>

        <p>Laconia is a personal project to learn the fundamentals of programming and modern webapp development from scratch. The main goals of my project are to learn MVC (Model View Controller) architecture, the OOP (Object-Oriented Programming) paradigm, routing, modern development practices, and how to tie it all together to make a functional webapp.</p>

        <p>Laconia runs on PHP 7.2 and MySQL. It uses composer to autoload classes and configuration and utility files, as well as future tests through PHPUnit. Node is used to compile Sass to CSS via npm scripts.</p>

        <p>Please feel free to fork, use, comment, critique, suggest, improve or help in any way.</p>

        <p><a class="button" href="/view-users">View Users</a></p>
        
    </div>

<?php include __DIR__ . '/partials/footer.php'; ?>