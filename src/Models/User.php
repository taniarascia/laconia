<?php

class User extends Model
{
	public function isUsernameTaken($username)
	{
		$query = 'SELECT username FROM users WHERE username = :username';

		return $this->db->execute($query, [$username])->rowCount() > 0;
	}

	public function create($credentials)
	{
		$query = 'INSERT INTO users (username, password, email) VALUES (:username, :password, :email)';

		return $this->db->execute($query, $credentials)->rowCount();
	}

	public function get($credentials)
	{
		$query = 'SELECT id, username, password FROM users WHERE username = :username';

		return $this->db->execute($query, $credentials)->fetch();
	}
}