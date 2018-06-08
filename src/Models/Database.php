<?php

class Database
{
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbname = DB_NAME;

	private $handler;
	private $error;

	private $stmt;


	public function __construct()
	{
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
		$options = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,
		];

		try {
			$this->handler = new PDO($dsn, $this->user, $this->pass, $options);
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
		}
	}


	public function execute($query, $params = NULL)
	{
		$stmt = $this->handler->prepare($query);

		if (!is_null($params) && is_array($params)) {
			foreach ($params as $name => $value) {
				if (is_int($value)) {
					$type = PDO::PARAM_INT;
				} else if (is_bool($value)) {
					$type = PDO::PARAM_BOOL;
				} else if (is_null($value)) {
					$type = PDO::PARAM_NULL;
				} else {
					$type = PDO::PARAM_STR;
				}

				$stmt->bindValue($name, $value, $type);
			}
		}

		try {
			$stmt->execute();
			$this->stmt = $stmt;
		} catch (PDOException $e) {
			if ($e->errorInfo[1] == 1062) {
				$this->error = 'Duplicate entry';
			} else {
				$this->error = $e->getMessage();
			}
		}

		return $this;
	}


	public function fetch()
	{
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}


	public function fetchAll()
	{
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	public function rows()
	{
		return $this->stmt->rowCount();
	}


	public function lastInsertId()
	{
		return $this->handler->lastInsertId();
	}
}
