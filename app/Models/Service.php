<?php 
namespace app\Models;

use app\core\TimeHelper;

class Service extends \app\core\Model{
	//
	public $service_id;

	#[\app\validators\NonNull]
	#[\app\validators\NonEmpty]
	protected $description; //NonEmpty is a attribute

	#[\app\validators\NonNull]
	#[\app\validators\DateTime]
	protected $datetime; //protected instead of public to force the execution of __set (and __get) in Model
	public $client_id;

	protected function setdatetime($value){
		//You are trying to replace the following located in the Service controller $service->datetime = TimeHelper::DTInput($_POST['datetime']);
		
		//on setting, change the timezone
		$this->datetime = TimeHelper::DTInput($value);
	}

	protected function setdescription($value){
		$this->description = htmlentities($value, ENT_QUOTES); 
		//htmlentities() avoids crosss sight scripting
		//XSS: cross sight scripting
		//		its when you take javascript and put it into the input
		//		which will mess up your code/website 
	}

	// V1. theres methods are protected to force the execution og __call in Model
	protected function insert(){
		$SQL = "INSERT INTO service (description, datetime, client_id) value (:description, :datetime, :client_id)";

		$STH = self::$connection->prepare($SQL);
		//basically inserting the values into the database
		$data = [
					'description'=>$this->description,
					'datetime'=>$this->datetime,
					'client_id'=>$this->client_id
				];
		$STH->execute($data); 
		$this->service_id = self::$connection->lastInsertId();
	}

	protected function update(){
		$SQL = "UPDATE service SET description=:description, datetime=:datetime WHERE service_id=:service_id";
		$STH = self::$connection->prepare($SQL);
		//basically inserting the values into the database
		$data = [
					'description'=>$this->description,
					'datetime'=>$this->datetime,
					'service_id'=>$this->service_id
				];

		$STH->execute($data); 
		return $STH->rowCount();
	}


	public function delete(){	
		$SQL = "DELETE FROM service WHERE service_id=:service_id"; 
		$STH = self::$connection->prepare($SQL);
		$data = ['service_id' => $this->service_id];  

		$STH->execute($data); 
		return $STH->rowCount();
		
	}

	public function getAllForClient($client_id){

		$SQL = "SELECT * FROM service WHERE client_id=:client_id";

		$STH = self::$connection->prepare($SQL);
		$STH->execute(['client_id'=>$client_id]); 

		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\Models\\Service');
		return $STH->fetchAll();	
		
	}

	public function get($service_id)
	{
		$SQL = "SELECT * FROM service WHERE service_id=:service_id";
		$STH = self::$connection->prepare($SQL);
		$STH->execute(['service_id' => $service_id]);
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\Models\\Service');
		return $STH->fetch();

	}

	public function getClient()
	{
		$SQL = "SELECT * FROM client WHERE client_id=:client_id";
		$STH = self::$connection->prepare($SQL);
		$STH->execute(['client_id' => $this->client_id]);
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\Models\\Client');
		return $STH->fetch();
	}

}