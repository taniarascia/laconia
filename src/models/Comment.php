<?php

/** 
 * Comment Class
 * 
 * Interact with comments.
 */

namespace Laconia;
use Laconia\Model;

class Comment extends Model
{   
    /**
     * Select all comments.
     * Returns multiple rows.
     */

    public function getComments() 
    {
        $query = "SELECT * 
                  FROM comments";

        $this->db->query($query);
            
        $comments = $this->db->resultset();

        return $comments;
    }

    /**
     * Insert a new comment.
     * Returns a Boolean.
     */

    public function insertComment($username, $comment) 
    {
        $query = "INSERT INTO comments 
                      (username, comment, created) 
                  VALUES 
                      (:username, :comment, :created)";
        
        $this->db->query($query);
        $this->db->bind(':username', $username);
        $this->db->bind(':comment', $comment);
        $this->db->bind(':created', date("Y-m-d H:i:s"));

        $result = $this->db->execute();

        return $result;
    }
}