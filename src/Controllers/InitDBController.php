<?php

class InitDBController extends Controller
{
	public function get()
	{
		(new InitDB())->init();
	}
}
