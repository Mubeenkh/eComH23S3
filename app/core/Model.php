<?php 
namespace app\core;

use PDO;

class Model{

	// public $connection;
	public static ?PDO $connection = null;  
		//the question mark means its a nullable PDO
	public function __construct(){

		// in order tp hide line 15 to 22 from other, we have to place it in a ".env" file
		//we dont want to advertise our user name and password, so that hackers cant access it
		if(self::$connection == null){

			//loads up the configuration (.env ) file from the local/given folder
			//should be placed in root (htdocs)
			$env = \Dotenv\Dotenv::createImmutable(getcwd());
			// var_dump($env);
			//Load the .env file

			$env->load();
			//telling it that you need some stuff in order to run the app, should not be empty
			$env->required(['db_host','db_user','db_pass','db_name','db_charset']);

			$host = $_ENV['db_host'];
			$dbname = $_ENV['db_name'];
			$user = $_ENV['db_user'];
			$pass = $_ENV['db_pass'];
			$charset = $_ENV['db_charset']; //utfa character set

			try {

				$options = [
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE =>PDO::FETCH_CLASS,
					PDO::ATTR_EMULATE_PREPARES => false
				];

				# MySQL with PDO_MYSQL
				// $DBH = new \PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

				//$this->connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
						//since connection is static now, we have thi change "this" to self
						//"self" is like a "this" but its a pointer for the class
				self::$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $pass,$options);

				self::$connection->query("SET NAMES $charset");
				//tells the database that everything will be encoded in utfa8mb4


			}
			catch(PDOException $e) {
			 	echo $e->getMessage();
			}
		}
	}
}