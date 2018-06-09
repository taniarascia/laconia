<?php

class RegisterController extends Controller
{
	public $pageName = 'Register';

	public function get()
	{
		$this->view('register');
	}

	public function post()
	{
		$user = new User();

		// validation (should be in validate method)
		$username = !empty($_POST['username']) ? trim($_POST['username']) : NULL;
		$password = !empty($_POST['password']) ? trim($_POST['password']) : NULL;
		$email = !empty($_POST['email']) ? trim($_POST['email']) : NULL;

		if ($user->isUsernameTaken($username)) {
			$this->message('Username already taken');
			header('Location: /register');
			exit;
		}

		$password = password_hash($password, PASSWORD_BCRYPT);

		if ($user->create([$username, $password, $email])) {
			$this->message('User created successfully');
		}

		header('Location: /login');
	}
}
