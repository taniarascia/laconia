<?php 

class Index extends Controller
{
    public function show() {
        $this->authenticate();
        $this->redirect('home');
    }
}