<!DOCTYPE html>

<html>
<!-- Don't Ever Do This Again: mix M, V, and C -->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form action="" method="post">
		<label>First name:</label>
		<!-- name is key, value is what you put in the input box -->
		<input type="text" name="firstName"> <br>

		<label>Last name:</label>
		<input type="text" name="lastName"> <br>

		<label>Newsletter:</label>
		<input type="checkbox" name="newsletter">Yes! I want to receive the newsletter!<br>

		<input type="submit" name="action" value="Send">

	</form>
	<br><br><br>
</body>
</html>

<?php 

// get input data from the HTTP request
// data sent through the GET method

if(isset($_GET['name']))
	echo $_GET['name'],'<br>';

// if echo works the do it, if not (??) echo ''
echo $_GET['name'],'<br>' ?? ' <br>';

foreach ($_GET as $key => $value) {
	echo "$key => $value<br>";
}
echo "<pre>";
var_dump($_GET);
echo "</pre>";

//get to the POST data with $_POST
//POST data is sent in the HTTP headers
echo "<br><br>POST DATA:<br><pre>";
var_dump($_POST);
echo "</pre>";


echo "REQUEST_METHOD:", $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	echo "THIS WAS SENT THROUGH THE HTTP HEADERS";
}