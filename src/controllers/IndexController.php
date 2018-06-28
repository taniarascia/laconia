<?php 

use Laconia\Controller;

class IndexController extends Controller
{
    public $page_title = 'A Modern PHP App';
    public $user;
    public $session;
    public $comments;
    public $isLoggedIn;

    public function post() 
    {
        $post = filter_post();
        $this->comment->insertComment($post['username'], $post['comment']);        
    }

    public function get() 
    {
        $this->isLoggedIn = $this->session->isUserLoggedIn();

        $userId = $this->session->getSessionValue('user_id');
        $this->user = $this->userControl->getUser($userId);

        $this->comments = $this->comment->getComments();
        $this->view('index'); 
    }
}