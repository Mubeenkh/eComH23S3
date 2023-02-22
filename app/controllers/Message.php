<?php
namespace app\controllers;

class Message extends \app\core\Controller{


	public function send(){
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

	public function delete($message_id){

		$user_id = $_SESSION['user_id'];
		$message = new \app\Models\Message();
		$success = $message->delete($message_id,$user_id);
		if($success){
			header('location:/User/profile?success=Message deleted.');
		}else{
			header('location:/User/profile?error=You are not allowed to delete this message.');
		}
		// header('location:/User/profile?success=Message deleted.');

	}

}