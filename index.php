<?php

/*
Hvað er OOP?
 http://code.tutsplus.com/tutorials/object-oriented-php-for-beginners--net-12762
 OOP stendur fyrir object oriented programming sem er forritunarstíll 
 sem gerir þróanda kleift að hópa saman svipuð verk inn í klassa. Þetta
 heldur kóðanum frá því að vera fullur af edurtekningum og gerir það
 auðvelt að viðhalda honum.
 
Afhverju að nota OOP?
 Þú ættir að nota OOP í PHP vegna þess að það heldur þér frá því að 
 eldurtaka sjálfan þig og gerir það auðvelt að viðhalda kóðanum.
 Til þess að búa ekki til spagettí.
 Það er betra að nota OOP þegar að þú ert með kóða sem að þú vilt stækka
 í framtíðinni (ef að þú þarft að breyta einhverju þá þarf yfirleitt
 ekki að breyta nema á einum stað, í stað þess að þurfa að fara í gegnum
 allann kóðann og breyta sama hlutnum á mörgum stöðum) eða ef að 
 verkefnið þitt á að verða stórt en ef að þú ert með einn lítinn hlut sem 
 þarf að gera og  þú getur ekki notað hann í neitt annað þá getur þú 
 notað procedural forritun.
Dæmi frá http://code.tutsplus.com/tutorials/object-oriented-php-for-beginners--net-12762
 Procedural lausnin
 */
function changeJob($person, $newjob)
{
  $person['job'] = $newjob; // Change the person's job
  return $person;
}
 
function happyBirthday($person)
{
  ++$person['age']; // Add 1 to the person's age
  return $person;
}
 
$person1 = array(
  'name' => 'Tom',
  'job' => 'Button-Pusher',
  'age' => 34
);
 
$person2 = array(
  'name' => 'John',
  'job' => 'Lever-Puller',
  'age' => 41
);
 
// Output the starting values for the people
echo "<pre>Person 1: ", print_r($person1, TRUE), "</pre>";
echo "<pre>Person 2: ", print_r($person2, TRUE), "</pre>";
 
// Tom got a promotion and had a birthday
$person1 = changeJob($person1, 'Box-Mover');
$person1 = happyBirthday($person1);
 
// John just had a birthday
$person2 = happyBirthday($person2);
 
// Output the new values for the people
echo "<pre>Person 1: ", print_r($person1, TRUE), "</pre>";
echo "<pre>Person 2: ", print_r($person2, TRUE), "</pre>";
/*
 Hérna er OOP útyppigáfa af sama kóða
*/
class Person
{
  private $_name;
  private $_job;
  private $_age;
 
  public function __construct($name, $job, $age)
  {
      $this->_name = $name;
      $this->_job = $job;
      $this->_age = $age;
  }
 
  public function changeJob($newjob)
  {
      $this->_job = $newjob;
  }
 
  public function happyBirthday()
  {
      ++$this->_age;
  }
}
 
// Create two new people
$person1 = new Person("Tom", "Button-Pusher", 34);
$person2 = new Person("John", "Lever Puller", 41);
 
// Output their starting point
echo "<pre>Person 1: ", print_r($person1, TRUE), "</pre>";
echo "<pre>Person 2: ", print_r($person2, TRUE), "</pre>";
 
// Give Tom a promotion and a birthday
$person1->changeJob("Box-Mover");
$person1->happyBirthday();
 
// John just gets a year older
$person2->happyBirthday();
 
// Output the ending values
echo "<pre>Person 1: ", print_r($person1, TRUE), "</pre>";
echo "<pre>Person 2: ", print_r($person2, TRUE), "</pre>";

/*
 Í þessu dæmi er OOP lausnin betri vegna þess að búa til nýja persónu
 er mun stittri kóði og erfiðara að gera mistök.

 Munurinn á private og protected?
 Public properties og methods eru aðgengileg hvaðan sem er(innan klassans og utan 
 classans)
 Protected þýðir að það er einungis hægt að nálgast propertyið eða methodið innan
 classans eða í descendant classes
 Private property eða method er einungis hagt að komast í innan classans þar sem
 það er skilgreint

 Namespaces og autoloading?   https://mattstauffer.co/blog/a-brief-introduction-to-php-namespacing
 Það eru rosa skrítnir hlutir sem að ég finn ekki alltof mikið að skyljanlegum leiðbeningum um :(
 Namespaces voru sett í php til þess að gera það auðveldara að sortera classana sína
 Namespace er þá bara eins og virtual directory til þess að sortera classana
 síðan getur maður notað [use] til þess að fá aðgang að öðrum clössum ef að property eða function innan
 classa sem að kemur úr öðru namespace þá getur maður notað [use x as z] til þess að refera til x 
  Autoloader er síðan forrit sem setur þessa classa í alvöru möppur. PSR-4 er autoloader sem hægt er að nota.

 Interfaces
  Interface er eins og blueprint fyrir classa.
  Þú getur implementað eins mörgum interfaceum og not eru fyrir.
  Interface eru ekki nauðsinleg fyrir lítil verkefni sem að þú gerir sjálfur en ef að þú ert t.d. að vinna
  í hóp og classar eiga að vera eins upp byggðir þá getur þú notað interface þannig að classar séu með sömu
  sömu functions með sömu nöfnum. 

 Bók class
*/
class Book
{
    private $_title;
    private $_price;

    public function setPrice($newPrice)
    {
     $this->_price = $newPrice; 
    }

    public function getPrice()
    {
      return $this->_price;
    }

    public function setTitle($newTitle)
    {
      $this->_title = $newTitle;
    }

    public function getTitle()
    {
      return $this->_title;
    }

    public function __construct($title, $price)
    {
      $this->_price = $price;
      $this->_title = $title;
    }
}
/*
Object útfrá bók classanum
*/
$efnafraedi = new Book("Efnafræði 101", 4899);
$staerdfraedi = new Book("Stærðfræði 501", 8999);
$islenska = new Book("Brennu Njáls saga", 7499);
/*
class sem extendar book
*/
class ProBook extends Book
{
  private $_publisher;

  public function getPublisher()
  {
    return $this->_publisher;
  }

  public function setPublisher($newPublisher)
  {
    $this->_publisher = $newPublisher;
  }
}
/*
  Birta upplýsingar
*/
  $islenska2 = new ProBook("Ljóðamál", 499);
  $islenska2->setPublisher("Arnaldur Indriðason");
  echo $islenska2->getPrice();
  echo $islenska2->getTitle();
  echo $islenska2->getPublisher();
/*
  User class
*/
class User
{
  private $_email;
  private $_password;

  public function setPassword($newPass)
  {
    $this->_password = $newPass;
  }

  public function getPassword()
  {
    return $this->_password;
  }

  public function setEmail($newEmail)
  {
    $this->_email = $newEmail;
  }

  public function __construct($userInfo)
  {
    $this->_email = $userInfo[0];
    $this->_password = $userInfo[1];
  }
}

class MyClass
{
	//Class properties and methods go here
	public $prop1 = "I'm a class property!";//Class propertie 

	public function setProperty($newval)//class method
	{
		$this->prop1 = $newval;//tekur inn breytu og breytir prop1 í hana
	}

	public function getProperty()
	{
		return $this->prop1 . "<br />";
	}
}

$obj = new MyClass;//gerir nýtt object útfrá classanum
 
echo $obj->prop1;//callar á propertiið prop1 í classanum

var_dump($obj)
/*


*/
?>