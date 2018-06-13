<?php

class Register extends Controller
{
    public $page_title = 'Register';
    public $title = SITE_NAME;
    public $message;

    public function get() {
        if (isset($_POST['register'])) {
            $user = new User();
            
            // Get form values
            $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
            $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
            $email = !empty($_POST['email']) ? trim($_POST['email']) : null;

            // Password check:

            if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["cpassword"])) {
                $password = test_input($_POST["password"]);
                $cpassword = test_input($_POST["cpassword"]);
                if (strlen($_POST["password"]) <= '8') {
                    $passwordErr = "Your Password Must Contain At Least 8 Characters!";
                }
                elseif(!preg_match("#[0-9]+#",$password)) {
                    $passwordErr = "Your Password Must Contain At Least 1 Number!";
                }
                elseif(!preg_match("#[A-Z]+#",$password)) {
                    $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
                }
                elseif(!preg_match("#[a-z]+#",$password)) {
                    $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
                }
            }
            elseif(!empty($_POST["password"])) {
                $cpasswordErr = "Please Check You've Entered Or Confirmed Your Password!";
            } else {
                 $passwordErr = "Please enter password   ";
            }
            
            // TO ADD: Error checking (username characters, password length, etc).
            $usernameSearchResults = $user->isUsernameAvailable($username);

            // Username already exists error
            if ($usernameSearchResults > 0) {
                $this->message = 'That username already exists! Try again.';
            } else {
            
                // Hash the password
                $password = $user->encryptPassword($password);
                $result = $user->registerNewUser($username, $password, $email);
                
                // User registration successful
                if ($result) {
                    $this->message = 'Thank you for registering with our website. <a href="/login">Login</a>';
                }
            }
        }
        $this->view('register');
    }
}