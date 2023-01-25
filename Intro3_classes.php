<?php 

class Person
{
	public $firstName;
	public $lastName;
	protected $age;
	protected $weight;
	private static $count = 0; //static are tied to the class and not to the object

	function __construct($firstName,$lastName,$age,$weight)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->age = $age;
		$this->weight = $weight;

		//Wrong $this->count++;
		self::$count++;
	}

	function __toString()
	{
		return "$this->firstName $this->lastName is $this->age years old and weighs in at $this->weight pounds. <br>";
	}

	public static function count()
	{
		//Wrong return $this->count;
		return self::$count;
	}
}

echo "There are ",Person::count()," people in the program. <br>";

$person = new Person('Mubeen','Khan',21,-25);
echo $person;
//Wrong echo $person->count();
echo "There are ",Person::count(),(Person::count()==1 ?"person":"people"), " in the program. <br>";

class Pugilist extends Person
{
	public function fight($other)
	{
		return ($this->weight > $other->weight ? $this : $other);
	}
}

$pugilist1 = new Pugilist('Mert','Salvador',18,160);
$pugilist2 = new Pugilist('Rachelle', 'Jenniffer',19,116);

$winner = $pugilist1->fight($pugilist2);
echo "The Winner is $winner";