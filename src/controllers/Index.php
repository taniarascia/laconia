<?php 

use Laconia\Controller;

class Index extends Controller
{
    public $page_title = 'A PHP Application';

    public function get() {
        $this->view('index'); 
    }
}