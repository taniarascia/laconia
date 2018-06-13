<?php

class ExceptionNotFound extends Controller
{
    public $page_title = '404';
    public $title = SITE_NAME;

    public function get() {
        $this->view('404');
    }
}