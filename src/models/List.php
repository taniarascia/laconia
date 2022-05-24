<?php

namespace Laconia;

use Laconia\Model;

/** 
 * List Class
 * 
 * Interact with lists and list items.
 * 
 * Lists, similar to to-dos or notes, are created in the `lists` table, 
 * and each entry is inserted into the `list_items` table. List items are
 * associated to a list by the `list_id` column. 
 */
class ListClass extends Model
{

    /**
     * Retrieve all lists associated with a user. Takes
     * the entire user as a parameter, using the `id` column.
     * Returns multiple results.
     */
    public function getListsByUser($user)
    {
        $query = "SELECT * 
                  FROM lists 
                  WHERE user_id = :user_id
                  ORDER BY created DESC";

        $this->db->query($query);
        $this->db->bind(':user_id', $user['id']);

        $lists = $this->db->resultset();

        return $lists;
    }

    /**
     * Retrieve a single list associated with a user. 
     * Returns one result.
     */
    public function getListByListId($listId)
    {
        $query = "SELECT * 
                  FROM lists
                  WHERE id = :list_id";

        $this->db->query($query);
        $this->db->bind(':list_id', $listId);

        $list = $this->db->result();

        return $list;
    }

    /** 
     * Retrieve all lists by `list_id`.
     * Return multiple results.
     */
    public function getListItemsByListId($listId)
    {
        $query = "SELECT * 
                  FROM list_items 
                  WHERE list_id = :list_id";

        $this->db->query($query);
        $this->db->bind(':list_id', $listId);

        $lists = $this->db->resultset();

        return $lists;
    }

    /**
     * Create a new list and add all associated list items.
     * Returns boolean result of original list creation.
     */
    public function createList($user, $title, $post)
    {
        if (empty($title) || empty($post['list_item_0'])) {
            return false;
        } else {
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
                if ($key !== 'title' && $key !== 'csrf' && $value !== '') {
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

    /**
     * Edit an existing list.
     * Return number
     */
    public function editList($post, $listId)
    {
        $query = "UPDATE lists
                  SET title = :title
                  WHERE id = :list_id";

        $this->db->query($query);
        $this->db->bind(':title', $post['title']);
        $this->db->bind(':list_id', $listId);
        $this->db->execute();

        foreach ($post as $key => $value) {
            if ($value !== '' && $key !== 'csrf') {
                $query = "UPDATE list_items 
                          SET name = :name
                          WHERE id = :id AND
                                list_id = :list_id";

                $this->db->query($query);
                $this->db->bind(':name', $value);
                $this->db->bind(':id', $key);
                $this->db->bind(':list_id', $listId);

                $this->db->execute();
            }
        }

        return $this->db->execute();
    }

    /**
     * Delete a list and all associated list items.
     * Return a boolean.
     */
    public function deleteList($listId)
    {
        $query = "DELETE FROM lists
                  WHERE id = :id";

        $this->db->query($query);
        $this->db->bind(':id', $listId);

        $result = $this->db->execute();

        $query = "DELETE FROM list_items
                    WHERE list_id = :list_id";

        $this->db->query($query);
        $this->db->bind(':list_id', $listId);
        $this->db->execute();

        return $result;
    }
}
