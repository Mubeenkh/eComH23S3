<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Greetings</title>
</head>
<body>
	<!-- These two do the same thing -->
	Hi <?= $data ?>! <br>
	Hi <?php echo $data; ?>! <br>
	<a href="/index.php?url=/Main/index">Index</a>
	<a href="/index.php?url=/Main/index2">Index2</a>
	<a href="/index.php?url=/Main/greetings">Aloha Peopow</a>
</body>
</html>