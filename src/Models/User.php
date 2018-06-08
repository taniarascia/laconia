<?php

class User extends Model
{
	public function isUsernameTaken($username)
	{
		$query = 'SELECT COUNT(username) AS num FROM users WHERE username = :username';

		return (bool) $this->db->execute($query, [$username])->rows();
	}
}