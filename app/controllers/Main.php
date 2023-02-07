<?php 
namespace app\controllers;
//name of this controller is Main,we wanna make sure Main calls the view class
// which is why we extends Controller
class Main extends \app\core\Controller{ 
	function index(){
		// echo "<br> <b>yo bing chilling in the Main index </b>";
		$this->view('Main/index');
	}

	function index2(){
		// echo " <br> <b> This is the Main index2 </b>";
		$this->view('Main/index2');
	}

	function greetings($name = "Sir Mark"){  //name is an optional parameter now
		// echo " <br> <b> Aloha $name! </b>";
		$this->view('Main/greetings',$name);
	}

	function logUser(){
		if(isset($_POST['action'])){
			//data is sent
				//var_dump('$_POST');
			//open the log.txt

			$userLog = new \app\Models\UserLog();
			$userLog->name = $_POST['name'];
			$userLog->insert();

			//content is now in the model
			// $fh = fopen('log.txt', 'a'); //fh = file handle
			// fwrite($fh, "$_POST[name] has visited! \n");
			// fclose($fh);
			header('location:/Main/logUser');

		}else{
			//no data submitted: the user needs to see the form
			$this->view('Main/logUser');
		}
	}

	function viewUserLog(){
		$userLog = new \app\Models\UserLog();
		$content = $userLog->getAll();
		$this->view('Main/userLogList', $content); //call the view and pass the content
	}

	function logDelete($lineNumber){
		$userLog = new \app\Models\UserLog();
		$userLog->delete($lineNumber);
		header('location:/Main/viewUserLog'); //redirect

	}

}