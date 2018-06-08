<?php

class ExceptionController extends Controller
{
	public function initDB()
	{
		(new InitDB())->init();
	}

	public function homeView()
	{
		$this->pageName = 'Home';
		require $_SERVER['DOCUMENT_ROOT'] . '/src/views/home.view.php';
	}
}
