<?php
namespace app\Models;
//if i  ever want to change the log file name i can do it on line 4
define('LOG_FILE','log.txt');		

class UserLog{

	public $name;

	public function insert(){

		//TODO: also lock the file
		$fh = fopen(LOG_FILE, 'a'); //fh = file handle , a = reading
		flock($fh,LOCK_EX); //need an exlcusive lock to write
													// fwrite($fh, "$_POST[name] has visited! \n");
		fwrite($fh, "$this->name has visited!\n");  //How "this" works: for this intance, get me the name
		fclose($fh); //release the resource and the lock
	}

	public function getAll(){

		// file = reads entire file into an array(only used for reading)
		$contents = file(LOG_FILE);
		return $contents;
	}

	public function delete($lineNumber){
		//read the file
		$contents = $this->getAll();

		//write the file for each line that does not have this number
		$fh = fopen(LOG_FILE, 'w'); // w = writing
		flock($fh,LOCK_EX);
		foreach ($contents as $lineNum => $entry) {
			if($lineNum != $lineNumber){
				fwrite($fh, $entry);
			}
		}
		fclose($fh);
	} 

}
