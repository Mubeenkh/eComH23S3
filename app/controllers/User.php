<?php
namespace app\controllers;

// These are all class Attributes. They are defined on top of the class

class User extends \app\core\Controller{
	
	public function index(){  //login page

		if(isset($_POST['action'])){
			
			$user = new \app\Models\User();
			$user = $user->getByUsername($_POST['username']);
			
			//checking if theres something in my user inputs
			if($user){

				//takes the passwrods to be verified and the password_hash thats gonna be stored in the database
				if(password_verify($_POST['password'], $user->password_hash)){
					//the user is correct

					//Need to have session_start(); in init.php or else nothing stores
					//Stores the user_id in the database 
					$_SESSION['user_id'] = $user->user_id;  
					$_SESSION['username'] = $user->username;
					$_SESSION['secret_key'] = $user->secret_key;

					if(!$user->secret_key){
						header('location:/User/profile?error=Account not safe, please make your dam 2-factor Authentication');
					}
					else{
						header('location:/User/verify2fa');
					}

					
				}else{
					header('location:/User/index?error=Bad username/password combination');
				}

			}else{
				//no such user
				header('location:/User/index?error=Bad username/password combination'); //you dont want to let hackets know if the username already exists or not
			}

		}else{
			//display te form
			$this->view('User/index'); 
		}

	}

	public function register(){  //registration page

		if(isset($_POST['action'])){
			//process the input
			$user = new \app\Models\User();

			$usercheck = $user->getByUsername($_POST['username']);
			if(!$usercheck){
				$user->username = $_POST['username'];
				//taking the password and hashing it before storing it
				$user->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$user->insert();
				header('location:/User/index');
			}else{
				header('location:/User/register?error=Username ' . $_POST['username'] . ' already in use. Choose another.');
			}

		}else{
			//display te form
			$this->view('User/register'); //TODO: add the new view file
		}
	}

	public function logout(){
		session_destroy();
		header('location:/User/index');
	}


	//this is replacing the if statement.
	//its a path to the login class
	
	#[\app\filters\Login]
	public function profile(){
		//users "Secure place", 
		//If user is mot loged in, it will not run the rest of the code****
		// if(!isset($_SESSION['user_id'])){
		// 	header('location:/User/index');
		// 	return;	//to make sure they dont get access to what comes after this if
		// }
		$message = new \app\Models\Message();
		$messages = $message->getAllForUser($_SESSION['user_id']);
		$this-> view('User/profile',$messages);
	}

	#[\app\filters\Login]
	public function somethingSecret(){
		echo "If you see this, you are logged in";
	}

	public function makeQRCode()
	{
		$data = $_GET['data'];
		\QRcode::png($data);
	}

	#[\app\filters\Login]
	public function setup2fa()
	{

		if(isset($_POST['action'])){

			$currentcode = $_POST['currentCode'];
			if(\app\core\TokenAuth6238::verify($_SESSION['secret_key'],$currentcode)){

				$user = new \app\Models\User();
				$user->user_id = $_SESSION['user_id'];
				$user->secret_key = $_SESSION['secret_key'];
				$user->update2fa();
				header('location:/User/profile?success=Authentication works');
			}else{
				header('location:/User/setup2fa?error=token not verified!');//reload
			}

		}else{
			$secretkey = \app\core\TokenAuth6238::generateRandomClue();
			$_SESSION['secret_key'] = $secretkey;
			$url = \app\core\TokenAuth6238::getLocalCodeUrl(
				$_SESSION['username'],
				// $_SESSION['user_id'],
				'Awesome.com',
				$secretkey,
				'Awesome App'      
			);
			// $user = \app\Models\
			$this->view('User/twofasetup', $url);
		}

	}

	#[\app\filters\Login]
	public function verify2fa()
	{
		$this->view('User/verify2fa');
	}

	
}