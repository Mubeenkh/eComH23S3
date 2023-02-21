<?php
namespace app\controllers;

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
					header('location:/User/profile');
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

	public function profile(){
		//users "Secure place"
		if(!isset($_SESSION['user_id'])){
			header('location:/User/index');
			return;	//to make sure they dont get access to what comes after this if
		}
		$message = new \app\Models\Message();
		$messages = $message->getAllForUser($_SESSION['user_id']);
		$this-> view('User/profile',$messages);
	}

	public function sendMessage(){
		if(isset($_POST['action'])){
			
			$receiver = $_POST['receiver'] ?? ''; //if receiver doesnt exist then use empty string to avoid error messages
			$user = new \app\Models\User();
			$user = $user->getByUsername($receiver); //going to return a user record

			if($user){
				$message = new \app\Models\Message();
				$message->receiver = $user->user_id;

				//set FK to a PK value
				$message->sender = $_SESSION['user_id'];
				$message->message = $_POST['message'];
				$message->insert();
				
			}else{
				header('location:/User/profile?error=' . 
					"$receiver is not a valid user. No message sent." );
			}


		}

		header('location:/User/profile');
		
	}
}