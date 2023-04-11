<?php

//to accept languages from the querystring as follows: mysite.com?lang=fr_CA
if(isset($_GET['lang'])){ //if there is a language choice in the querystring
	$lang = $_GET['lang'];//use this language
	setcookie("lang",$lang, 0, '/'); //set a cookie for the entire domain
}else{
	$default = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
	//this gets the langauge from the browser

	//if nothing is set to lang, then default will be english
	$lang=(isset($_COOKIE["lang"])?$_COOKIE["lang"]:'en'); //from cookie or default

}

//extract the root language from the complete locale to use with strftime
$rootlang = preg_split('/_/', $lang);
$rootlang = (is_array($rootlang)?$rootlang[0]:$rootlang);
setlocale(LC_ALL, $rootlang.".UTF8");//which locale to use. .UTF8 is to ensure proper encoding of output
bindtextdomain($lang, "locale"); //pointing to the locale folder for the language of choice
textdomain($lang); //what is the file name to find translations


//Fetch the User timezone
$tz = 'UTC';
if(isset($_COOKIE['TZ'])){
	$tz = $_COOKIE['TZ'];
}else {
	//get the timezone from the browser into a cookie called TZ
	//delimiter
	// Intl.DateTimeFormat().revolvedOptions().timeZone is a string value
	//  "/" means the entire domain
	// die() mmeans the process (script) is gonna die/end
	echo <<<EOE
	<html>
		<head>
			<meta http-equiv="refresh" content="1">
			<script type="text/javascript">
				if (navigator.cookieEnabled)
					document.cookie = "TZ="+ Intl.DateTimeFormat().resolvedOptions().timeZone + ";path=/";
			</script>
		</head>
	</html>
	EOE;
	die(); 
	
}