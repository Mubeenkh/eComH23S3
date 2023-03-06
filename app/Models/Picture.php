<?php
namespace app\Models;

class User extends \app\core\Model{
	public $filename;
	public $description;

	public function getByUsername($username){
		$SQL = 'SELECT * FROM User WHERE username = :username';  //:username is a palce holder

		$STH = $this->connection->prepare($SQL);
		$STH->execute(['username' => $username]);
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\User');

		return $STH->fetch();
	}

	public function insert(){
		$SQL = 'INSERT INTO User(username,password_hash) VALUES (:username, :password_hash)';  
		$STH = $this->connection->prepare($SQL);

		$STH->execute(['username' => $this->username,
					   'password_hash' => $this->password_hash]);
		
		return $this->connection->lastInsertId();  //returns the value of the new PK
	}
}