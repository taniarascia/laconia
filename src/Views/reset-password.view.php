<?php include __DIR__ . '/partials/header.php'; ?>

	<h2>Create New Password</h2>

	<form action="" method="post">
		<label for="password">Password</label>
		<input type="text" id="password" name="password"><br>
		<input type="submit" name="create" value="Create Password">
	</form>

	<a href="/public">Home</a> <a href="/register">Register</a> <a href="/forgot-password">Forgot Password</a>

<?php include __DIR__ . '/partials/footer.php'; ?>