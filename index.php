<?php
// Entry point to the Application
// Include the dependencies
require_once 'app/core/init.php';
// To include external files in PHP we can: include, include_once, require, and require_once
// require is for stuff you need
// include can be less fatal
// _once is to ensure thing only are included once


//Testing inputting from date
// try{
// 	// $date = new DateTime('2024/01/32');
// 	// var_dump($date);
// 	new DateTime('2024/01/32');
// 	return true;
// }catch(Exception $e){
// 	// echo "Bad thing happened: $e";
// 	return  false;
// }



new app\core\App;