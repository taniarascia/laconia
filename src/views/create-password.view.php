<?php include __DIR__ . '/partials/header.php'; ?>

<section class="content-section">
    <div class="form-container">
        <h3>Create a new password</h3>
        <p>Make sure your password conforms to all proper security standards.</p>

        <?php include __DIR__ . '/partials/message.php'; ?>

        <form id="form-create-password">
            <input name="csrf" type="hidden" value="<?= $this->csrf; ?>">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">

            <input type="submit" name="create" value="Create Password">
        </form>
    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>