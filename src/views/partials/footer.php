</main>

<footer>
    <section class="site-footer">
        <div class="tiny-container text-center">
            <div class="footer-brand">
                <a href="/">
                    <img src="<?= $this->getImage('amphora.png'); ?>" class="logo">
                    <span>
                        <?= SITE_NAME; ?>
                    </span>
                </a>
            </div>
            <p class="summary">Laconia is an MVC framework written in PHP that demonstrates how to work with important web concepts like routing, authentication, security, object-oriented design, and MVC architecture. Open source MIT.</p>
            <a class="github-button" href="https://github.com/taniarascia/laconia" data-size="large" data-show-count="true" data-icon="star" aria-label="Star Laconia on GitHub">Laconia</a>
            <a class="github-button" href="https://github.com/taniarascia" data-size="large" data-show-count="true" aria-label="Star Laconia on GitHub">@taniarascia</a>
        </div>
    </section>
</footer>

</section>

<script src="<?php echo $this->getScript('scripts'); ?>"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>