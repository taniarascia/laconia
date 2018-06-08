<?php

class InitDB extends Model
{
	public function init()
	{
		$query = file_get_contents('../../migrations/init.sql');
		$this->db->execute($query);
	}
}
