<?php
namespace app\validators;

use Attribute;
use \app\core\Validator;

#[Attribute]
class DateTime implements Validator{

	public function isValid($data) : bool
	{

		try{
			// $date = new DateTime('2024/01/32');
			// var_dump($date);
			new \DateTime($data);
			return true;
		}catch(Exception $e){
			// echo "Bad thing happened: $e";
			return  false;
		}
	}

}