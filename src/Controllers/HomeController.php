<?php

class HomeController extends Controller
{
	public function get()
	{
		$this->authenticate();
		$this->pageName = 'Home';
		$this->view('home');
	}
}
