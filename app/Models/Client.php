<?php 
namespace app\Models;

class Client extends \app\core\Model{
	public $client_id;
	public $first_name;
	public $last_name;
	public $middle_name;

	public function insert(){
		$SQL = "INSERT INTO client (first_name, last_name, middle_name) value (:first_name, :last_name, :middle_name)";
		$STH = $this->connection->prepare($SQL);
		//basically inserting the values into the database
		$data = ['first_name'=>$this->first_name,
					'last_name'=>$this->last_name,
					'middle_name'=>$this->middle_name];
		$STH->execute($data); 
		$this->client_id = $this->connection->lastInsertId(); //returns the primary key for...
	}

	public function delete($client_id){	//delete a client
		$SQL = "DELETE FROM client WHERE client_id=:client_id"; //:client_id can be changed to anything
		$STH = $this->connection->prepare($SQL);
		$data = ['client_id' => $client_id];  // 'client_id' has to match to whast writtne in lien 22 ex: :client_id
		$STH->execute($data); 
		
	}

	public function getAll(){	//getting all the cliens
		$SQL = "SELECT * FROM client";
		$STH = $this->connection->prepare($SQL);
		$STH->execute(); 
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\Models\\Client');
		return $STH->fetchAll();	//returns an array of clients
		
	}

}