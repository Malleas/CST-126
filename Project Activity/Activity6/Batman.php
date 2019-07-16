<?php
require_once ('Superhero.php');

class Batman extends Superhero
{

}

$startingHealth = random_int(1,1000);
$batman = new Superhero("Batman", $startingHealth);