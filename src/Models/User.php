<?php

class User extends Model
{
	public function isUsernameTaken($username)
	{
		$query = 'SELECT COUNT(username) AS num FROM users WHERE username = :username';

		return $this->db->execute($query, [$username])->rowCount() > 0;
	}

	public function create($credentials)
	{
		$query = 'INSERT INTO users (username, password, email) VALUES (:username, :password, :email)';

		return $this->db->execute($query, $credentials);
	}
}