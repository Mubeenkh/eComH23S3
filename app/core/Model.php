<?php 
namespace app\core;

use PDO;
use ReflectionClass;

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
	
	// V3.this method is called by the __call function to make sure the data is correct
	public function isValid() : bool
	{
		//the goal of this function is to validate the data
		//return true if all the data is valid (if its true, make the _call)
		//return false otherwise

		$reflection = new ReflectionClass($this); //$this because u are trying to validate the current model
		$properties = $reflection->getProperties(); //this give me an array
		
		foreach ($properties as $property) {

			$attributes = $property->getAttributes(
				//goes through property and get the attributes,and makes sure that all you are getting are attributes, nothing else
				\app\core\Validator::class,
				\ReflectionAttribute::IS_INSTANCEOF

			); 
			$data = $property->getValue($this);	//this gets the data for the property
			//have another foreach in case you have multiple attributes
			foreach ($attributes as $attribute) {
				//where we actually perform the validation
				
				//1. create an object of that validator class
				$validator = $attribute->newInstance();

				//2. run the validation method on the data in the property	
				if(!$validator->isValid($data)){
					// if even a single value/data is not valid(bad data), return false
					return false;
				}
			}
		}
		//if everything goes well in the loop (data is valid) return true
		return true;

	}

 	//__call always takes a method name, can also takes arguments
 	// V2. call method is being triggered when invoking inaccessible methods (protected methods)
	public function __call($method, $arguments)
	{
		if($this->isValid())
		{
			call_user_func_array([$this,$method], $arguments);

			// $this->$method(...$attributes);
			// $this->$method($arguments)
		
		}

		//testing if this method works
		// echo $method;
		// die();
	}

	// validation to make sure to call something that doesnt exist
	//name: name of the property
	public function __set($name, $value)
	{
		//name: can be ex: datetime
		$method = "set$name"; //ex: setdatetime
		//this is the method,
		if(method_exists($this, $method)){
			$this->$method($value);
		}else{
			$this->$name = $value; //adding default behaviour
		}

		//testing if this methof works
		// echo "$name => $value";
		// die();
	}

	//when outputting the protected values, you want it to get it
	public function __get($name)
	{
		//$name has "$" because you want the name of the property you are tryinh to pass
		if(isset($this->$name)){
			return $this->$name;
		}else{
			return '';
		}
	}
}