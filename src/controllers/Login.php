<?php

class Login extends Controller
{
    public $page_title = 'Login';
    public $title = SITE_NAME;
    public $message;

    public function get() {
        if (isset($_POST['login'])) {
            $user = new User();
            
            // Get form values
            $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
            $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
            $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
            
            // Retrieve the user account information for the given username.
            $the_user = $user->getUser($username);
            
            // Could not find a user with that username
            if (!$the_user) {
                $this->message = 'Incorrect username / password combination! <a href="/">Back</a>';
            } else {
        
                // User account found.
                $validPassword = password_verify($password, $the_user['password']);
                
                if ($validPassword) {
                    
                    // User login session
                    $_SESSION['user_id'] = $the_user['id'];
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['time_logged_in'] = time();

                    $this->message = $_SESSION['user_id'];
                    $this->redirect('');
                } else {
                    $this->message = 'Incorrect username / password combination!';
                }
            }
        }
        $this->view('login');
    }
}