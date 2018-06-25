<?php

/** 
 * List Class
 * 
 * Interact with lists and list items.
 * 
 * Lists, similar to to-dos or notes, are created in the `lists` table, 
 * and each entry is inserted into the `list_items` table. List items are
 * associated to a list by the `list_id` column. 
 */

namespace Laconia;
use Laconia\Model;

class ListClass extends Model
{

    /**
     * Retrieve all lists associated with a user. Takes
     * the entire user as a parameter, using the `id` column.
     * Returns multiple results.
     */

    public function getListsByUser($user) {
        $query = "SELECT * 
                  FROM lists 
                  WHERE user_id = :user_id";

        $this->db->query($query);
        $this->db->bind(':user_id', $user['id']);
            
        $lists = $this->db->resultset();

        return $lists;
    }

    /** 
     * Retrieve all lists by `list_id`.
     * Return multiple results.
     */

    public function getListById($id) {
        $query = "SELECT * 
                  FROM list_items 
                  WHERE list_id = :list_id";

        $this->db->query($query);
        $this->db->bind(':list_id', $id);
            
        $lists = $this->db->resultset();

        return $lists;
    }

    /**
     * Create a new list and add all associated list items.
     * Returns boolean result of original list creation.
     */

    public function createList($user, $title, $post) {
        $query = "INSERT INTO lists 
                      (user_id, title, created) 
                  VALUES 
                      (:user_id, :title, :created)";
        
        $this->db->query($query);
        $this->db->bind(':user_id', $user['id']);
        $this->db->bind(':title', $title);
        $this->db->bind(':created', date("Y-m-d H:i:s"));

        $result = $this->db->execute();

        // Get id of list we just created
        $listId = $this->db->lastInsertId();

        // Create list_items entries
        foreach ($post as $key => $value) {
            if ($key !== 'title' && $value !== '') {
                $query = "INSERT INTO list_items 
                              (user_id, list_id, name, created) 
                          VALUES 
                              (:user_id, :list_id, :name, :created)";
                
                $this->db->query($query);
                $this->db->bind(':user_id', $user['id']);
                $this->db->bind(':list_id', $listId);
                $this->db->bind(':name', $value);
                $this->db->bind(':created', date("Y-m-d H:i:s"));
        
                $this->db->execute();
            }
        }

        return $result;
    }
}