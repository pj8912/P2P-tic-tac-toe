<?php


namespace TTC\Models;

class User
{
	private $conn;
	
    public function __construct($db)
	{
		$this->conn = $db;
	}

	private $table = "users";
	public $user_id, $fullname,$username, $email, $pwd;


	public function check_user()
	{
		$sql = "SELECT * FROM {$this->table} WHERE user_uname = :user_uname";
		$stmt = $this->conn->prepare($sql);
		// $stmt->bindParam(':user_email', $this->email);
        $stmt->bindParam(':user_uname', $this->username);
		$stmt->execute();
		return $stmt;
	}


	public function getUserById()
	{
		$sql = "SELECT * FROM users WHERE user_id = :user_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':user_id', $this->user_id);
		$stmt->execute();
		return $stmt;
	}


	public function createUser()
	{
		$sql = "INSERT INTO {$this->table}(user_fullname, user_uname, user_email, user_pwd, created_at)
		 VALUES(:user_fullname, :user_uname , :user_email, :user_pwd, NOW())";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':user_fullname', $this->fullname);
		$stmt->bindParam(':user_uname', $this->username);

		$stmt->bindParam(':user_email', $this->email);
		$stmt->bindParam(':user_pwd', $this->pwd);
		$stmt->execute();
	}

	public function update_last_seen($uid)
	{
		$sql = "UPDATE users SET last_seen = NOW() WHERE user_id = '$uid' ";
		$stmt = $this->conn->query($sql);
		$stmt->execute();
	}
	
	
}

