<?php 

class Index extends Controller
{
    public $page_title = 'Home';

    public function get() {
       $this->view('index'); 
    }
}