<?php 
namespace app\core;

class Controller{
	
	//is calls/includes a file so we can display it
	function view($name, $data = []){
		include('app/views/' . $name . '.php'); //mainly just sets php at the end 
	}

}