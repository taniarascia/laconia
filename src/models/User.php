<?php

/** 
 * User Class
 * 
 * Interact with users and user data.
 * 
 * Any call to the database regarding the users table will go through
 * the User class. The User class extends the Model class, which simply 
 * instantiates a Database instance that allows us to connect. 
 * 
 * From here, we can get information on any user by their user ID, 
 * username, or email, or we can get a list of all users. This class
 * also includes calls to the password request table.
 * 
 */

namespace Laconia;
use Laconia\Model;

class User extends Model
{   
    /**
     * Select all data from a single user by user ID.
     * Return a single row.
     */

    public function getUser($userId) {
        $query = "SELECT * 
                  FROM users 
                  WHERE id = :id 
                  LIMIT 1";

        $this->db->query($query);
        $this->db->bind(':id', $userId);
            
        $user = $this->db->result();

        return $user;
    }

    /**
     * Select all user data from all users.
     * Return multiple rows.
     */

    public function getAllUsers() {
        $query = "SELECT * FROM users";

        $this->db->query($query);
            
        $users = $this->db->resultset();

        return $users;
    }

    /**
     * Select all data from a single user by username.
     * Return a single row.
     */

    public function getUserByUsername($username) {
        $query = "SELECT * 
                  FROM users 
                  WHERE username = :username 
                  LIMIT 1";

        $this->db->query($query);
        $this->db->bind(':username', $username);
            
        $user = $this->db->result();

        return $user;
    }

    /**
     * Select all data from a single user by email address.
     * Return a single row.
     */

    public function getUserByEmail($email) {
        $query = "SELECT * 
                  FROM users 
                  WHERE email = :email 
                  LIMIT 1";

        $this->db->query($query);
        $this->db->bind(':email', $email);
        
        $user = $this->db->result();

        return $user;
    }

    /**
     * Register a new user by inserting all relevant registration
     * data into the users table.
     * Returns true if successful.
     */

    public function registerNewUser($username, $password, $email, $role) {
        $query = "INSERT INTO users 
                      (username, password, email, role) 
                  VALUES 
                      (:username, :password, :email, :role)";
        
        $this->db->query($query);
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $password);
        $this->db->bind(':email', $email);
        $this->db->bind(':role', $role);

        $result = $this->db->execute();

        return $result;
    }

    /**
     * Query the database for existing usernames to ensure a new
     * user registration does not override an existing user.
     * Return a boolean.
     */

    public function isUsernameAvailable($username) {
        $username = strtolower($username);
        $query = "SELECT COUNT(username) 
                  AS num 
                  FROM users 
                  WHERE LOWER(username) = :username";

        $this->db->query($query);
        $this->db->bind(':username', $username);

        $result = $this->db->result();

        return $result['num'];
    }

    /**
     * Query the database for existing emails to ensure a new
     * user registration does not override an existing user.
     * Return a boolean.
     */

    public function isEmailAvailable($email) {
        $query = "SELECT COUNT(email) 
                  AS num 
                  FROM users 
                  WHERE email = :email";

        $this->db->query($query);
        $this->db->bind(':email', $email);

        $result = $this->db->result();

        return $result['num'];
    }

    /**
     * Query the database for usernames to ensure a new
     * user registration does not override an existing user.
     * Return a boolean.
     */

    public function createPasswordRequest($userId, $token) {
        $query = "INSERT INTO password_reset_request
                    (user_id, date_requested, token)
                  VALUES
                    (:user_id, :date_requested, :token)";
        
        $this->db->query($query);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':date_requested', date('Y-m-d H:i:s'));
        $this->db->bind(':token', $token);

        $result = $this->db->execute();

        return $result;
    }

    /**
     * Before allowing a user to change their password, verify 
     * the password request has taken place on the same session
     * based on the GET variables passed through.
     * Return the matching result.
     */

    public function verifyPasswordRequest($userId, $passwordRequestId, $token) {
        $query = "SELECT id, user_id, date_requested 
                  FROM password_reset_request
                  WHERE 
                      user_id = :user_id AND 
                      token = :token AND 
                      id = :id";

        $this->db->query($query);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':id', $passwordRequestId);
        $this->db->bind(':token', $token);

        $requestInfo = $this->db->result();

        return $requestInfo;
    }

    /**
     * Update the password of the user who requested a password
     * change.
     * Return a boolean.
     */

    public function resetUserPassword($passwordHash, $userId) {
        $query = "UPDATE users 
                  SET password = :password 
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind(':password', $passwordHash);
        $this->db->bind(':id', $userId);
    
        $result = $this->db->execute();

        return $result;
    }
}