<?php

class LoginController extends Controller
{
	public $pageName = 'Login';

	public function get()
	{
		$this->view('login');
	}

	public function post()
	{
		$user = new User();

		// validation (should be in validate method)
		$username = !empty($_POST['username']) ? trim($_POST['username']) : NULL;
		$password = !empty($_POST['password']) ? trim($_POST['password']) : NULL;

		$user = $user->get([$username]);

		if ($user && password_verify($password, $user->password)) {
			$_SESSION['userId'] = $user->id;
			$_SESSION['username'] = $user->username;
			$_SESSION['isLogged'] = true;

			header('Location: /home');
			exit;
		}

		$this->message('Invalid username/password');
		header('Location: /home');
	}
}
