<?php
namespace app\core;

interface Validator {
	public function isValid($data) : bool; //returns true for valid data
}