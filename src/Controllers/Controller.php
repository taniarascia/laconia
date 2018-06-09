<?php

abstract class Controller
{
	protected $pageName = '';
	protected $title = SITE_NAME;

	protected function view($view)
	{
		$view = strtolower($view);
		require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Views/' . $view . '.view.php';
	}

	protected function getMessages()
	{
		$messages = '';

		foreach ($_SESSION['messages'] as $message) {
			$messages .= $message . '<br>';
		}

		echo $messages;
		$_SESSION['messages'] = [];
	}

	protected function message($message)
	{
		$_SESSION['messages'][] = $message;
	}

	public function authenticate()
	{
		if (!isset($_SESSION['userId'], $_SESSION['isLogged'], $_SESSION['username'])) {
			$this->message('Access denied');
			header('Location: /login');
		}
	}
}
