<?php 
namespace app\Models;

class Client extends \app\core\Model{
	public $client_id;
	public $first_name;
	public $last_name;
	public $middle_name;

	public function insert(){
		$SQL = "INSERT INTO client (first_name, last_name, middle_name) value (:first_name, :last_name, :middle_name)";
		$STH = self::$connection->prepare($SQL);
		//basically inserting the values into the database
		$data = [
					'first_name'=>$this->first_name,
					'last_name'=>$this->last_name,
					'middle_name'=>$this->middle_name,
					'client_id'=>$this->client_id
				];
		$STH->execute($data); 
		return $STH->rowCount(); 
	}

	public function update(){
		$SQL = "UPDATE client SET first_name=:first_name, last_name=:last_name, middle_name=:middle_name WHERE client_id=:client_id";
		$STH = self::$connection->prepare($SQL);
		//basically inserting the values into the database
		$data = ['first_name'=>$this->first_name,
					'last_name'=>$this->last_name,
					'middle_name'=>$this->middle_name];
		$STH->execute($data); 
		$this->client_id = self::$connection->lastInsertId(); //returns the primary key for...
	}


	public function delete($client_id){	//delete a client
		$SQL = "DELETE FROM client WHERE client_id=:client_id"; //:client_id can be changed to anything
		$STH = self::$connection->prepare($SQL);
		$data = ['client_id' => $client_id];  // 'client_id' has to match to whast writtne in lien 22 ex: :client_id
		$STH->execute($data); 
		
	}

	public function getAll(){	//getting all the cliens
		$SQL = "SELECT * FROM client";
		$STH = self::$connection->prepare($SQL);
		$STH->execute(); 
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\Models\\Client');
		return $STH->fetchAll();	//returns an array of clients
		
	}

	public function get($client_id)
	{
		$SQL = "SELECT * FROM client WHERE client_id=:client_id";
		$STH = self::$connection->prepare($SQL);
		$STH->execute(['client_id' => $client_id]);
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\Models\\Client');
		return $STH->fetch();

	}

	//return Service records for this client: $services = client->getServices();
	public function getServices(){

		// $SQL = "SELECT * FROM service WHERE client_id=:client_id";

		$SQL = "SELECT * FROM service 
		JOIN branch 
		ON service.branch_id = branch.branch_id
		WHERE client_id=:client_id";

		$STH = self::$connection->prepare($SQL);
		$STH->execute(['client_id'=>$this->client_id]); 

		// $STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\Models\\Service');
		$STH->setFetchMode(\PDO::FETCH_OBJ); //changed to FETCH_OBJ because you are trying to get data from a JOINT table so two tables in this case
		return $STH->fetchAll();	
		
	}

}