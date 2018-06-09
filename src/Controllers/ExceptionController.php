<?php

class ExceptionController extends Controller
{
	public function notFound()
	{
		$this->pageName = '404 Not Found';
		$this->view('404');
	}
}
