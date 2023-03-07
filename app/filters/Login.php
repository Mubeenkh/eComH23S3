<?php
namespace app\filters;

#[\Attribute]
class Login implements \app\core\AccessFilter{	//provides the interface

	//this class will check if the user is logged in, if no it wont run the rest of the code *where this class is called*
	public function execute(){

		if(!isset($_SESSION['user_id'])){
			header('location:/User/index');
			return true;	// not enough, we have to tell the router to do something
							//return true, if the person is not allwed to be there
		}
		return false;		//return fasle, if the person can be there
	}

}