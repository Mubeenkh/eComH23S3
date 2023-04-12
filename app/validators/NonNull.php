<?php
namespace app\validadors;

use Attribute;
use app\core\Validator;

#[Attribute]
class NonNull implements Validator
{
	public function isValid($data) : bool
	{
		//make sure you font have null values (could be set as null is out SETTER)
		return $data != null;
	}
}