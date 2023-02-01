<?php 

//expects a function as a parameter
//it load the class 
spl_autoload_register(

	function($class_name)
	{
		require_once($class_name . '.php');
	}
);
