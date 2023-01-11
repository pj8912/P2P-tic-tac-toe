<?php

namespace TTC\Database;

class Datbase{

    private $host = 'localhost';
	private $uname = 'root';
	private $pwd = '';
	private $db = 'ttc';

	private $conn;
	
	public function connect()
	{
		try {
			$this->conn = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->db, $this->uname, $this->pwd);
			$this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} catch (\PDOException $e) {
			echo "err: " . $e->getMessage();
		}
		return $this->conn;
	}

}

