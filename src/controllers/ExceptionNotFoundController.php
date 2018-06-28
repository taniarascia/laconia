<?php

use Laconia\Controller;

class ExceptionNotFoundController extends Controller
{
    public $page_title = '404';

    public function get() 
    {
        $this->view('404');
    }
}