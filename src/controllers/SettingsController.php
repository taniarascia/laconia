<?php

use Laconia\Controller;
use Laconia\ListClass;

class SettingsController extends Controller
{
    public $pageTitle = 'Settings';
    public $message;
    public $errors = [];
    public $user;
    public $csrf;

    public function post()
    {
        $get = filter_get();
        $post = filter_post();

        // Get user by session value
        $userId = $this->session->getSessionValue('user_id');
        $this->session->authenticate($userId);
        $this->session->validateCSRF($post['csrf']);

        if (isset($post['delete_user'])) {
            $this->userControl->deleteUser($userId);
            $this->session->logout();

            $this->message = USER_DELETED;

            echo $this->message;
            exit;
        } else if (isset($post['email'])) {
            $this->user = $this->userControl->getUser($userId);

            if ($post['email'] !== $this->user['email']) {
                $emailSearchResults = $this->userControl->isEmailAvailable($post['email']);

                if ($emailSearchResults > 0) {
                    $this->errors[] = EMAIL_EXISTS;
                }
            }

            if (!empty($this->errors)) {
                $this->errorList = $this->getErrors($this->errors);
                $this->message = $this->errorList;

                echo $this->message;
                exit;
            } else {
                // Update settings
                $this->userControl->updateUserSettings($post, $userId);
                $this->user = $this->userControl->getUser($userId);

                $this->message = SETTINGS_UPDATE_SUCCESS;

                echo $this->message;
                exit;
            }
        }
    }

    public function get()
    {
        $userId = $this->session->getSessionValue('user_id');
        $this->session->authenticate($userId);
        $this->csrf = $this->session->getSessionValue('csrf');

        // Get user by session value
        $this->user = $this->userControl->getUser($userId);

        $this->view('settings');
    }
}
