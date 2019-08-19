<?php

use Laconia\Controller;

class LandingController extends Controller
{
    public $pageTitle = null;
    public $message;
    public $user;
    public $session;
    public $comments;
    public $isLoggedIn;
    public $commentArray = [];
    public $csrf;

    public function post()
    {
        $post = filter_post();
        $this->session->validateCSRF($post['csrf']);
        $this->isLoggedIn = $this->session->isUserLoggedIn();

        $userId = $this->session->getSessionValue('user_id');

        $this->user = $this->userControl->getUser($userId);

        $lastComment = $this->comment->getLastComment();

        if ($lastComment['comment'] === $post['comment']) {
            $this->message = DUPLICATE_COMMENT;
            exit;
        }

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
        $this->csrf = $this->session->getSessionValue('csrf');

        $this->comments = $this->comment->getComments();
        $this->view('landing');
    }
}
