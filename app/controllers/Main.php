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

}