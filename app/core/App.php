<?php
namespace app\core;
//this class does all the routing for the site
class App
{
	//this entire function routed URL to a method call
	function __construct()
	{	
		// echo 'The constructor for the App class has been called';

				//This is where we want to route the request to the appropriate classes/methods
				//echo $_GET['url'] ?? 'No url provided';		//if no url is given, then print out the '' message


		//we wish to rout our request to /controllers/method
		$request = $this->parseURL($_GET['url'] ?? '');
		// var_dump($request);

		//Default
		$controller = 'Main';
		$method = 'index';
		$params = [];

		//Check if the requested controller is in our controllers folder?
		//request[0] is th first file in the folder
		if(file_exists('app/controllers/' . $request[0] . '.php')) 
		{
			// echo "the $request[0] controller exists";
			$controller = $request[0];
			
			//remove the $request[0] element
			unset($request[0]); //remove first item from the array because we consumemed it

		}

		$controller = 'app\\controllers\\' . $controller;  //app\controllers\Main
		//$controller = new Main();	
		$controller = new $controller; 						//creates a new inst. Main
		
		
		if(isset($request[1]) && method_exists($controller, $request[1]))
		{
			$method = $request[1];
			//remove the $request[1] element
			unset($request[1]);
		}
		
		$params = array_values($request);   //array_values(input): reads an array, take the values from it, and create another array from it

		//$controller->index(); 
		//$controller->$method();
		
		/////// 1 start Access filtering ///////
		//this is the right place for access filtering
		if($this->filter($controller,$method,$params)){
			return;	//deny access to the method call
		}

		/////// 1 end Access filtering ///////

		// call_user_func_array(): Call the controller method with parameter
		call_user_func_array([$controller, $method], $params);
	}

	/////// 2 start Access filtering ///////
	public function filter($controller,$method,$params){
		//we want to read the class methods and attributes
			//we have to build a Reflection object to read the methods, properties, attributes
		$reflection = new \ReflectionObject($controller);		// you need to pass an object tp ReflectionObject 
		$classAttributes = $reflection->getAttributes(

			\app\core\AccessFilter::class,
			\ReflectionAttribute::IS_INSTANCEOF

		);

		$methodAttributes = $reflection->getMethod($method)->getAttributes(

			\app\core\AccessFilter::class,
			\ReflectionAttribute::IS_INSTANCEOF

		);	//we get the methods and read its attributes

		$attributes = array_values(array_merge($classAttributes, $methodAttributes)); 	//array_values makes sures you dont include null values
		//putting all the attributes in one single list
		foreach ($attributes as $attribute) {
			//i have to take that attribute, get the instance of the class (object), and use that instance
			$filter = $attribute->newInstance(); //making a new instance of this class and same it filter
			
			//filter has a function called execute
			if ($filter->execute()) {
				return true;
			}
		}
		return false;

	}
	/////// 2 start Access filtering ///////

	function parseURL($url)
	{
		return explode('/', trim($url,'/'));
	}
}