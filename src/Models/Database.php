<?php

class Database
{
	private static $db;
	private $pdo;

	private function __construct()
	{
		$opt = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];

		$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHAR;
		$this->pdo = new PDO($dsn, DB_USER, DB_PASS, $opt);
	}

	public static function instance()
	{
		if (self::$db === NULL) {
			self::$db = new self;
		}

		return self::$db;
	}

	public function execute($sql, $args = [])
	{
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute($args);
		return $stmt;
	}
}
