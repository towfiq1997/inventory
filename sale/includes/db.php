<?php

/**
 * 
 */
define("HOST", "localhost");
define("USER", "shebabar_shebabari");
define("PASS", "mysql!8Dy()");
define("DB", "shebabar_inv");

class Database
{
	private $con;

	public function connect()
	{
		$this->con = new Mysqli(HOST, USER, PASS, DB);
		if ($this->con) {
			return $this->con;
		}
		return "DATABASE_CONNECTION_FAIL";
	}
}

//$db = new Database();
//$db->connect();
