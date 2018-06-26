<?php

/**
 * Model Class
 * 
 * Create a new instance of the Database class.
 * 
 * The Model class is an abstract class that creates
 * a new instance of the Database class, allowing us
 * to interact with the database without having to create
 * a new instance in each class.
 */

namespace Laconia;

abstract class Model
{
	protected $db;

	public function __construct() 
	{
		$this->db = new Database();
	}
}