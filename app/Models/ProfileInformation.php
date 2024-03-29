<?php
namespace app\Models;

class ProfileInformation extends \app\core\Model{
	public $user_id;
	public $first_name;
	public $last_name;
	public $middle_name;
	public $picture;

	public function getByUserId($user_id){
		//: is a place holder
		$SQL = "SELECT * FROM profile_information 
				WHERE user_id=:user_id";
		$STH = self::$connection->prepare($SQL);
		$STH->execute( ['user_id' => $user_id] );
		$STH->setFetchMode(\PDO::FETCH_CLASS,'app\\Models\\ProfileInformation');
		return $STH->fetch();
	}

	public function insert(){
		$SQL = "INSERT INTO profile_information(user_id,first_name,last_name,middle_name, picture) 
				VALUE (:user_id,:first_name,:last_name,:middle_name,:picture)";

		$STH = self::$connection->prepare($SQL);

		$data = [
			'user_id'=>$this->user_id,
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'middle_name' => $this->middle_name,
			'picture'=> $this->picture	
		];

		$STH->execute( $data );
		return $STH->rowCount();
	}

	public function update(){
		//modify object without changing the user_id

		$SQL = "UPDATE `profile_information` 
				SET `first_name`=:first_name, `last_name`=:last_name, `middle_name`=:middle_name, `picture`=:picture 
				WHERE user_id=:user_id";

		$STH = self::$connection->prepare($SQL);

		$data = [
			'user_id'=>$this->user_id,
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'middle_name' => $this->middle_name,
			'picture'=>$this->picture
		];

		$STH->execute( $data );
		return $STH->rowCount();
	}



}