<?php 

//expects a function as a parameter
spl_autoload_register(

	function($class_name)
	{
		require_once($class_name . '.php');
	}
);
