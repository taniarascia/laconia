<?php

use Laconia\Controller;

class ExceptionNotFound extends Controller
{
    public $page_title = '404';

    public function get() 
    {
        $this->view('404');
    }
}