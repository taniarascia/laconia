<?php 

class Index extends Controller
{
    public $page_title = 'Home';
    public $title = SITE_NAME;

    public function get() {
       $this->view('index'); 
    }
}