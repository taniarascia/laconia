<?php 

class Index extends Controller
{
    public $page_title = 'Index';

    public function get() {
        $this->view('index'); 
    }
}