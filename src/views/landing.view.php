<?php include __DIR__ . '/partials/header.php'; ?>

<section class="content-section content-accent">
    <div class="small-container">
        <div class="lead">
            <h1>Laconia</h1>
            <p>An MVC framework from scratch in PHP</p>
            <a class="button accent-button" href="/register">Demo</a>
            <a class="button" href="https://github.com/taniarascia/laconia">View Source</a>
        </div>
    </div>
</section>

<section class="content-section no-padding-bottom">
    <div class="small-container">
        <h2 class="text-center">What is Laconia?</h2>
        <p>Laconia is a project created by <a href="https://www.taniarascia.com" target="_blank">Tania Rascia</a> to learn how to make a modern MVC framework from scratch without using any libraries or dependencies. Since Laconia has no external frameworks, it can be a helpful starting point for beginner PHP developers to learn the concepts of authentication, object-oriented architecture, Model-View-Controller concepts, routing, and creating a database schema.</p>
        <p>Laconia runs on PHP 7.2 and MySQL and uses Composer for autoloading classes. It is a simple web application that allows the creation of users and allows users to log in to an user panel and create their own public profile.</p>
        <p>Feel free to <a href="/register">create an account</a> and play around with it, or <a href="https://github.com/taniarascia/laconia" target="_blank">view the source</a>.</p>
    </div>
</section>

<section class="content-section">
    <div class="container">
        <div class="flex-row">
            <div class="flex-small">
                <div class="card text-center">
                    <h3>MVC</h3>
                    <p>Uses Model View Controller architecture.</p>
                </div>
            </div>
            <div class="flex-small">
                <div class="card text-center">
                    <h3>Routing</h3>
                    <p>Route all your pages through a single entry point.</p>
                </div>
            </div>
            <div class="flex-small">
                <div class="card text-center">
                    <h3>Authentication</h3>
                    <p>Create secure users with hashed passwords.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>