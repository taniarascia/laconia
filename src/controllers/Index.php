<?php 

use Laconia\Controller;

class Index extends Controller
{
    public $page_title = 'A Modern PHP App';

    public function get() 
    {
        $this->view('index'); 
    }
}