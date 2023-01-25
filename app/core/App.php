<?php


class App
{
	function __construct()
	{	
		// echo 'The constructor for the App class has been called';

		//This is where we want to route the request to the appropriate classes/methods
		echo $_GET['url'] ?? 'No url provided';

		$request = $this->parseURL($_GET['url'] ?? '');
		var_dump($request);

	}

	function parseURL($url)
	{
		return explode('/',$url);
	}
}