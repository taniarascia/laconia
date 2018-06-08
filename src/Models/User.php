<?php

class User extends Model
{
	public function isUsernameTaken($username)
	{
		$query = 'SELECT COUNT(username) AS num FROM users WHERE username = :username';

//		$this->db->execute()
	}
}