<?php

class LogoutController extends Controller
{
	public function get()
	{
		unset($_SESSION['userId'], $_SESSION['isLogged'], $_SESSION['username']);
		$this->message('Successful log out');
		header('Location: /login');
	}

	public function post()
	{
		$this->get();
	}
}
