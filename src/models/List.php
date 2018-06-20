<?php

class ListClass extends Model
{
    public function getListsByUser($user) {
        $query = "SELECT * FROM lists WHERE user_id = :user_id";

        $this->db->query($query);
        $this->db->bind(':user_id', $user['id']);
            
        $lists = $this->db->resultset();

        return $lists;
    }

    public function getListById($id) {
        $query = "SELECT * FROM lists WHERE list_id = :lost_id";

        $this->db->query($query);
        $this->db->bind(':list_id', $listId);
            
        $list = $this->db->result();

        return $list;
    }

    public function createList($user, $title, $post) {
        // Create list entry
        $query = "INSERT INTO lists (user_id, title, created) VALUES (:user_id, :title, :created)";
        
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
                $query = "INSERT INTO list_items (user_id, list_id, name, created) VALUES (:user_id, :list_id, :name, :created)";
                
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