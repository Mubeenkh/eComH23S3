<?php
namespace app\validadors;

use Attribute;
use app\core\Validator;

#[Attribute]
class NonEmpty implements Validator
{
	public function isValid($data) : bool
	{
		//php has a empty method that returns a boolean value
		//if empty return true, we want it to return false
		return !empty($data);
	}
}