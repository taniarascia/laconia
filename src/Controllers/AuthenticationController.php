<?php

class AuthenticationController
{
	public function register()
	{
		$pageName = 'Register';

		// validation
		$username = !empty($_POST['username']) ? trim($_POST['username']) : null;
		$pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
		$email = !empty($_POST['email']) ? trim($_POST['email']) : null;
	}


	public function login()
	{

	}


	public function logout()
	{

	}


	public function forgotPassword()
	{

	}


	public function forgotPasswordAction()
	{

	}
}
