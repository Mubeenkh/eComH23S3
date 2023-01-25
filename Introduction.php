<?php 

//don't close the PHP unless you have to?> 

<?= 'these are the echo tags <?= ... ?> <br>' ?>
<?php echo 'these are echo tags <?= ... ? > <br>'; ?>

<?php
//variable start with underscore or letters
$_variableNameInCamelCase = "";
$x = 4;
$y = 4.5;
$txt = 'Tarzan Loves Jane $x times more than Cheeta <br>' ;
echo $txt;
$txt = "Tarzan Loves Jane $x times more than Cheeta <br>";
echo $txt;

//Arrays
$values = array(4,5,4.5,$x,$y,$txt);
//var_dump(): Great for debugging 
echo '<pre>';
var_dump($values);
echo '</pre>';

$values2 = ['something',8,$values];
echo '<pre>';
print_r($values2);
echo '</pre>';

//if elseif else
$score = 90;

if($score < 60){
	$score= 'bruh';
}elseif ($score < 70){
	$score= 'D';
}elseif ($score < 80){
	$score= 'C';
}elseif ($score < 90){
	$score= 'B';
}else
	$score= 'A';

echo "$score <br>";

//switch case
switch ($score)
{
	case 'A':
		echo 'noice <br>';
		break;
	case 'B':
		echo 'you passed! <br>';
		break;
	case 'C':
		echo 'you passed! <br>';
		break;
	case 'D':
		echo 'you barely passed! <br>';
		break;

	default:
		echo 'you failed bruh! <br>';
		break;
}
echo '<br> Looping - Repetition: <br>';
//looping - repetition
echo 'Using While Loop <br>';
$i = 0;
while($i < count($values))
{
	echo $i,' => ',$values[$i],'<br>';
	$i++;
}

echo 'Using For Loop <br>';
for ($i=0; $i < count($values); $i++) 
{ 
	echo $i,' => ',$values[$i],'<br>';
}
echo 'Using For Each Loop <br>';
//        array     key    value
foreach ($values as $i => $value) 
{
	echo $i,' => ',$value,'<br>'; 
}

//Associative Arrays are dictionaries in PHP
$associativeArray = ['key1'=>'value1','key2'=>'value2','score'=>$score,'valuesArray'=>$values];

foreach ($associativeArray as $key => $value) {
	if(is_array($value))
	{
		echo $key, ' => ';
		var_dump($value);
		echo '<b>';

	}else{
		echo $key, ' => ',$value, '<br>';
	}
}

//Functions
function recursiveEcho($stuff)
{
	if(!is_array($stuff))
	{
		echo $stuff;
		return;
	}

	echo '[';
	foreach ($stuff as $key => $value) 
	{
		if(is_array($value))
		{
			recursiveEcho($value);
		}else
		{
			echo $key, ' => ',$value, '<br>';
		}
	}
	echo ']';
}
echo '<br><br>Using Functions: ************************<br>';

recursiveEcho($associativeArray);
recursiveEcho($score);

?>