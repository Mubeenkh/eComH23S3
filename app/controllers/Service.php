<?php
namespace app\controllers;

// use DateTime;
// use IntlDateFormatter;
use \app\core\TimeHelper; 
	// is meant to simplify your code, you dont have to write /app/core/TimeHelper::
	// instead i can just write TimeHelper::

class Service extends \app\core\Controller{

	// index has client id because on the client index view, we are passing and ID to the hyperlink for service
	public function index($client_id){//parent id
		$client = new \app\Models\Client();
		$client = $client->get($client_id);
		//plan: get the service records form the client model
		$this->view('Service/index', $client);
	}

	public function create($client_id){  //parent id

		if(isset($_POST['action'])){ 

			//Make a new service
			$service = new \app\Models\Service();

			//Populate the service
			// /htmlentities() filters out harmful inputs for the system
				// $service->description = htmlentities($_POST['description']);
				// $service->datetime = TimeHelper::DTInput($_POST['datetime']); //now date time should be set at UTC
			$service->description = $_POST['description'];
			$service->datetime = $_POST['datetime']; // these two value will now be checked and corrected by the setter in the Service Model and Model class

			$service->client_id = $client_id;
			$service->branch_id = $_POST['branch_id'];

			//Invoke the insert method
			$service->insert();

			//Redirect back to the list of clients
			header('location:/Service/index/' . $client_id);

		}else{

			$client = new \app\Models\Client();
			$client = $client->get($client_id);

			$branch = new \app\models\Branch();
			$branches = $branch->getAll();

			$this->view('Service/create',['client'=>$client,'branches'=>$branches]);
		}

	}

	
	public function delete($service_id){

		$service = new \app\Models\Service();
		$service = $service->get($service_id);
		// $client = $service->getClient();  //We will do this in the view

		if(isset($_POST['action'])){

			//Proceed with deletion:
			//place client_id in a variable before deleting the record 
			$client_id = $service->client_id;
			$service->delete(); 
			header('location:/Service/index/' . $client_id);

		}else{
			$this->view('Service/delete', $service);
		}
			
	}

	public function edit($service_id){
		//modify a Service record
		$service = new \app\Models\Service();
		$service = $service->get($service_id);


		if(isset($_POST['action'])){

			// save the data
			$service->description = $_POST['description'];
			$service->datetime = $_POST['datetime'];
			//we dont change key values ($client_id) which is a FK
			
			$service->branch_id = $_POST['branch_id'];

			//save the change to the databse
			$service->update();
			$client_id = $service->client_id;
			header('location:/Service/index/' . $client_id);

		}else{

			$branch = new \app\models\Branch();
			$branches = $branch->getAll();

			$this->view('Service/edit',['service'=>$service,'branches'=>$branches]);

		}
	}

}