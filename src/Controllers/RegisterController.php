<?php

class RegisterController extends Controller
{
	public $pageName = 'Register';

	public function view()
	{
		require $_SERVER['DOCUMENT_ROOT'] . '/src/views/register.view.php';
	}

	public function register()
	{
		$user = new User();

		// validation (should be in validate method)
		$username = !empty($_POST['username']) ? trim($_POST['username']) : NULL;
		$password = !empty($_POST['password']) ? trim($_POST['password']) : NULL;
		$email = !empty($_POST['email']) ? trim($_POST['email']) : NULL;

		if ($user->isUsernameTaken($username)) {
			die;
		}

		$password = password_hash($password, PASSWORD_BCRYPT);

		$user->create([$username, $password, $email]);

		header('Location: /');
	}
}
