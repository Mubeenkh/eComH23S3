<?php 

//expects a function as a parameter
//it load the class 
spl_autoload_register(

	function($class_name)
	{
		
		//for linux/unix/macOS compatibility...
		//							(search, replace, subject)
		$class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
		require_once($class_name . '.php');
	}
);
