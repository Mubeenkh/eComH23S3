<?php 
namespace app\Models;

class Branch extends \app\core\Model{
	//
	public $branch_id;
	public $name;
	public $street;
	public $city;
	public $province;
	public $postal;

	//get all the branches from the database
	public function getAll()
	{
		$SQL = "SELECT * FROM branch";
		$STH = self::$connection->prepare($SQL);
		$STH->execute();
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\Models\\Branch');
		return $STH->fetchAll();

	}


}