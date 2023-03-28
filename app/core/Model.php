<?php 
namespace app\core;


use PDO;

class Model{

	// public $connection;
	public static ?PDO $connection = null;  
		//the question mark means its a nullable PDO
	public function __construct(){


		if(self::$connection == null){

			$host = 'localhost';
			$dbname = 'webapplication';
			$user = 'root';
			$pass = '';
			$charset = 'utf8mb4'; //utfa character set
			try {
				# MySQL with PDO_MYSQL
				// $DBH = new \PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

				//$this->connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
						//since connection is static now, we have thi change "this" to self
						//"self" is like a "this" but its a pointer for the class
				self::$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $pass);

				self::$connection->query("SET NAMES $charset");
				//tells the database that everything will be encoded in utfa8mb4


			}
			catch(PDOException $e) {
			 	echo $e->getMessage();
			}
		}
	}
}