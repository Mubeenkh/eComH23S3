<?php 
namespace app\Models;

class Message extends \app\core\Model{
	public $message_id;
	public $sender;
	public $receiver;
	public $message;
	public $timestamp;

	public function insert(){
		$SQL = "INSERT INTO message (sender, receiver, message) value (:sender, :receiver, :message)";
		$STH = $this->connection->prepare($SQL);

		//basically inserting the values into the database
		$data = ['sender'=>$this->sender,
					'receiver'=>$this->receiver,
					'message'=>$this->message];
		$STH->execute($data); 
		$this->message_id = $this->connection->lastInsertId(); 

		//TODO: if needed get timestampmessage_id

	}

	public function delete($message_id, $user_id){ //user_id is the person deleting
		// only the owner of th message can delete it
		$SQL = "DELETE FROM message WHERE message_id=:message_id AND receiver = :receiver"; 
		$STH = $this->connection->prepare($SQL);
		$data = ['message_id' => $message_id,
					'receiver' => $user_id];  
		$STH->execute($data); 
		
	}

	public function getAllForUser($user_id){	
		$SQL = "SELECT * FROM message WHERE sender=:sender OR receiver=:receiver";
		$STH = $this->connection->prepare($SQL);

		$data = ['receiver'=>$user_id,
					'sender'=>$user_id];

		$STH->execute(); 
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\Models\\Message');
		return $STH->fetchAll();	//get all of the messages
		
	}

}