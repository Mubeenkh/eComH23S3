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

			$this->addPicture($_SESSION['user_id']); //to get the picture 

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

	public function addPicture($user_id){

		if( isset($_FILES['profilePicture']) && ($_FILES['profilePicture']['error'] == UPLOAD_ERR_OK) ){
			
			$info = getimagesize($_FILES['profilePicture']['tmp_name']);	//if no image is selected, then info is false

			$allowedTypes = [	"IMAGETYPE_JPEG" => ".jpg", 
								"IMAGETYPE_PNG" => ".png",
								"IMAGETYPE_GIF" => ".gif"
							];

			if($info == false){
				//file wasnt uploaded
				header('location:/Profile/edit?error=Wrong file format.');
			
			}else if(!array_key_exists($info[2], $allowedTypes)){
				//file is being uploaded, but check the image file type
				header('location:/Profile/edit?error=File type is not accepted.');	//wrong file type
			}else{
				//save the picture in the images folder
				$path = getcwd().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR; //this command will check if you are using "/" or "\" depending on the system you are using (windows or linux)

				$fileName = uniqid().allowedTypes[$info[2]]; //uniqid = will makes sure we dont overried a file with the same names 

				move_uploaded_file($_FILES['profilePicture']['tmp_name'], $path.$fileName);

				// header('location:/Profile/edit?success=Image saved.');
			}

		}else{

			$this->view('Profile/edit');

		}
		
	}

}