<?php
namespace app\controllers;

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
}