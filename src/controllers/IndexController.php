<?php 

use Laconia\Controller;

class IndexController extends Controller
{
    public $page_title = 'A Modern PHP App';
    public $message;
    public $user;
    public $session;
    public $comments;
    public $isLoggedIn;
    public $commentArray = [];

    public function post() 
    {
        $post = filter_post();
        $this->isLoggedIn = $this->session->isUserLoggedIn();

        $userId = $this->session->getSessionValue('user_id');
        $this->user = $this->userControl->getUser($userId);

        // Make sure people don't change the POST value to comment as someone else
        if ($this->isLoggedIn && $this->user['username'] === $post['username']) {
            $this->comment->insertComment($post['username'], $post['comment']);
            
            $this->commentArray[0] = $post['username'];
            $this->commentArray[1] = $post['comment'];

            print_r(json_encode($this->commentArray));
            exit;
            
        } else {
            $this->message = USERNAME_NOT_MATCHES;

            echo $this->message;
            exit;
        }
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