<?php
require_once ('Superhero.php');

class Superman extends Superhero
{

}
$startingHealth = random_int(1,1000);
$superman = new Superhero("Superman", $startingHealth);