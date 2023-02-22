<?php
namespace app\controllers;

class Profile extends \app\core\Controller{

	public function index(){
	
		//where we view the profile information
		$profile = new \app\Models\ProfileInformation();
		$profile = $profile->getByUserId($_SESSION['user_id']);
		


		if($profile){
			$this->view('Profile/index',$profile);	
		}else{
			header('location:/Profile/create');	//if no profile then forced to go there
		}


	} 

	public function create(){

		if(isset($_POST['action'])){

			$profile = new \app\Models\ProfileInformation();
			$profile->user_id = $_SESSION['user_id'];
			$profile->first_name = $_POST['first_name']; 
			$profile->last_name = $_POST['last_name']; 
			$profile->middle_name = $_POST['middle_name']; 

			$success = $profile->insert();						//inserts data into the profile table

			if($success){
				header('location:/Profile/index?success=Profile created.');
			}else{
				header('location:/Profile/index?error=Something went wrong. You can only have one profile');
			}

		}else{

			$this->view('Profile/create');
		}

	}

	public function edit(){

		$profile = new \app\Models\ProfileInformation();
		$profile = $profile->getByUserId($_SESSION['user_id']);

		if(isset($_POST['action'])){
			
			// $profile->user_id = $_SESSION['user_id'];	//when you edit profile you dont change the user_id
			$profile->first_name = $_POST['first_name']; 
			$profile->last_name = $_POST['last_name']; 
			$profile->middle_name = $_POST['middle_name']; 

			$success = $profile->update();					//updates data in the table

			if($success){
				header('location:/Profile/index?success=Profile modified.');
			}else{
				header('location:/Profile/index?error=Something went wrong.');
			}

		}else{

			$this->view('Profile/edit', $profile);  //adding $profile so we can view the information
		}

	}

}