<?php

namespace Laconia;

use Laconia;

abstract class Model
{
	protected $db;

	public function __construct() {
		$this->db = new Database();
	}
}