<?php

abstract class Controller
{
    protected $page_title;
    protected $title;
    protected $message;

    protected function view($view) {
        $view = strtolower($view);

        require_once $_SERVER['DOCUMENT_ROOT'] . '/../src/views/' . $view . '.view.php';
    }
}