<?php
namespace app\controllers;

// use DateTime;
// use IntlDateFormatter;
// use \app\core\TimeHelper;

class Service extends \app\core\Controller{

	// index has client id because on the client index view, we are passing and ID to the hyperlink for service
	public function index($client_id){	//parent id

		$client = new \app\Models\Client();
		$client = $client->get($client_id);
		//plan: get the service record from the client model
		$this->view('Service/index', $client);

	}

	public function create($client_id){  //parent id

		if(isset($_POST['action'])){ 

			//Make a new service
			$service = new \app\Models\Service();

			//Populate the service
			// /htmlentities() filters out harmful inputs for the system
			$service->description = htmlentities($_POST['description']);
			$service->datetime = $_POST['datetime'];
			$service->client_id = $client_id;

			//Invoke the insert method
			$service->insert();

			//Redirect back to the list of clients
			header('location:/Service/index/' . $client_id);

		}else{

			$client = new \app\Models\Client();
			$client = $client->get($client_id);
			$this->view('Service/create',$client);
		}

	}

	
	public function delete($service_id){

		$service = new \app\Models\Service();
		$service->get($service_id);
		// $client = $service->getClient();  //We will do this in the view

		if(isset($_POST['action'])){

			//Proceed with deletion:
			//place client_id in a variable before deleting the record 
			$client_id = $service->client_id;
			$service->delete(); 
			header('location:/Service/index' . $client_id);

		}else{
			$this->view('Service/delete', $service);
		}
			
	}

	public function edit($servicservicee_id){
		//modify a Service record
		$service = new \app\models\Service();
		$service = $service->get($service_id);


		if(isset($_POST['action'])){

			// save the data
			$service->description = $_POST['description'];
			$service->datetime = $_POST['datetime'];
			//we dont change key values ($client_id) which is a FK

			//save the change to the databse
			$service->update();
			$client_id = $service->client_id;
			header('location:/Service/index' . $client_id);

		}else{

			$this->view('Service/edit',$client);

		}
	}

}