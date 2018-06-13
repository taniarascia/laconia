<?php

class User extends Model
{
    // Return user array if user exists
    public function getUser($username) {
        $query = "SELECT id, username, password FROM users WHERE username = :username";

        $this->db->query($query);
        $this->db->bind(':username', $username);
            
        $user = $this->db->result();

        return $user;
    }
    
    // Check if username already exists
    public function isUsernameAvailable($username) {
        $query = "SELECT COUNT(username) AS num FROM users WHERE username = :username";

        $this->db->query($username);
        $this->db->bind(':username', $username);

        $row = $this->db->result();

        return $row['num'];
    }

    // Hash password
    public function encryptPassword($password) {
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
        
        return $password;
    }

    // Add new user to the database
    public function registerNewUser($username, $password, $email) {
        $query = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
        
        $this->db->query($query);
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $password);
        $this->db->bind(':email', $email);

        $result = $this->db->execute();

        return $result;
    }

}