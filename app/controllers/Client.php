<?php
namespace app\controllers;

use DateTime;
use IntlDateFormatter;
use \app\core\TimeHelper;

class Client extends \app\core\Controller{

	public function index(){
		$client = new \app\Models\Client();
		$clients = $client->getAll();
		$this->view('Client/index',$clients);
	}

	public function create(){

		if(isset($_POST['action'])){
			//Make a new Client
			$client = new \app\Models\Client();
			//Populate the client
			$client->first_name = $_POST['first_name'];
			$client->last_name = $_POST['last_name'];
			$client->middle_name = $_POST['middle_name'];
			//Invoke the insert method
			$client->insert();
			//Redirect back to the list of clients
			header('location:/Client/index');

		}else{
			$this->view('Client/create');
		}

		
	}
	public function delete($client_id){
			$client = new \app\Models\Client();
			$client->delete($client_id); //calling the action that actually deletes 
			header('location:/Client/index');
	}

	public function edit($client_id){
		//modify a clients record
		$client = new \app\models\Client();
		$client = $client->get($client_id);

		if(isset($_POST['action'])){

			//TODO: save the data
			$client->first_name = $_POST['first_name'];
			$client->last_name = $_POST['last_name'];
			$client->middle_name = $_POST['middle_name'];
			//save the change to the databse
			$client->update();
			header('location:/Client/index');
		}else{

			$this->view('Client/edit',$client);

		}
	}


	// Using the DateTime object
	public function date() {
		//TODO: get the user timezone choice (get this from the browser)
		$date = new DateTime();
		// $date = new DateTime('Tuesday, April 4, 2023, 15:23:03');

		global $lang;
		echo TimeHelper::DTOutput($date,$lang, 'America/Toronto'); //this returns a string

		// BETTER TO USE A CLass which we can call
		// $date = new DateTime('');
		// $date = new DateTime('Tuesday, April 4, 2023, 15:23:03');
		// // echo $date->format('l, F j, Y, G:i:s');
		// global $lang;
		// // echo $lang;
		// $fmt = new IntlDateFormatter(
		// 	//the language being used
		// 	$lang,

		// 	//DATE formatter
		// 	// IntlDateFormatter::LONG,
		// 	IntlDateFormatter::MEDIUM,
		// 	// IntlDateFormatter::SHORT,

		// 	//TIME formatter
		// 	// IntlDateFormatter::LONG
		// 	// IntlDateFormatter::MEDIUM
		// 	IntlDateFormatter::SHORT

		// );
		// echo '<br>',$fmt->format($date);
	}
}