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
echo "<br>-------------------------------------------------------------------------<br>";
echo "<br><b>Arrays: Two ways to PRINT and WRITE an array</b><br>";
$values = array(4,5,4.5,$x,$y,$txt);

//var_dump(): Great for debugging 
echo '<br><b>$values = array(4,5,4.5,$x,$y,$txt); <br> Using var_dump(): </b> ';
echo '<pre>';
var_dump($values);
echo '</pre>';

$values2 = ['something',8,$values];
echo '<b>$values2 = [',"something',8,",'$values]; <br> Using print_r(): </b>';
echo '<pre>';
print_r($values2);
echo '</pre>';


echo "<br>--------------------------------------------------------------------------<br>";
echo "<br> <b>if elseif else:</b> <br>";
//if elseif else
$score = 90;

echo "if($score < 60){ <br> $score= 'bruh'; <br> }elseif ($score < 70){ <br> $score= 'D'; <br>
	  }elseif ($score < 80){ <br> $score= 'C'; <br> }elseif ($score < 90){ <br> $score= 'B'; <br>
	  }else <br> $score= 'A'; <br>";

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

echo "<br> Score: $score <br>";

echo "<br>-------------------------------------------------------------------------<br>";
echo "<b> Switch case: </b> <br>";

echo "switch ($score) <br> { <br> case 'A': <br> echo 'noice'; <br> break; <br>
	  case 'B': <br> echo 'you passed!'; <br> break; <br>
	  case 'C': <br> echo 'you passed!'; <br> break; <br>
	  case 'D': <br> echo 'you barely passed!'; <br> break; <br>
      default: <br> echo 'you failed bruh!'; <br> break; <br> } <br>";
//switch case
switch ($score)
{
	case 'A':
		echo '<br>noice <br>';
		break;
	case 'B':
		echo '<br>you passed! <br>';
		break;
	case 'C':
		echo '<br>you passed! <br>';
		break;
	case 'D':
		echo '<br>you barely passed! <br>';
		break;

	default:
		echo '<br>you failed bruh! <br>';
		break;
}

echo "<br>-------------------------------------------------------------------------<br>";
echo '<br> <b>Looping - Repetition: </b> <br>';
//looping - repetition
echo '<b>Using While Loop</b> <br>';
$i = 0;
while($i < count($values))
{
	echo $i,' => ',$values[$i],'<br>';
	$i++;
}

echo '<b>Using For Loop</b> <br>';
for ($i=0; $i < count($values); $i++) 
{ 
	echo $i,' => ',$values[$i],'<br>';
}
echo '<b>Using For Each Loop</b> <br>';
echo 'foreach ($values as $i => $value) <br>';
//        array     key    value
foreach ($values as $i => $value) 
{
	echo $i,' => ',$value,'<br>'; 
}

echo "<br>-------------------------------------------------------------------------<br>";
//Associative Arrays are dictionaries in PHP
echo "<br> <b>Associative Arrays: HashMap from Prog Paterns</b> <br> ";
$associativeArray = ['key1'=>'value1','key2'=>'value2','score'=>$score,'valuesArray'=>$values];

foreach ($associativeArray as $key => $value) {
	if(is_array($value))
	{
		echo $key, ' => ';
		var_dump($value);
		echo '<br>';

	}else{
		echo $key, ' => ',$value, '<br>';
	}
}
echo "<br>-------------------------------------------------------------------------<br>";

//Functions
echo "<br> <b>Creating and Using Functions:</b>";

function recursiveEcho($stuff)
{
	if(!is_array($stuff))
	{
		echo " <br> $stuff";
		return;
	}

	echo '[ <br>';
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
echo '<br><br><b>Using Functions:  </b><br>';

recursiveEcho($associativeArray);
recursiveEcho($score);

?>