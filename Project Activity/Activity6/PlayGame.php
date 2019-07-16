<html>
<head>
<body>
<?php
require_once('Superman.php');
require_once('Batman.php');

$superman = new Superman();
$batman = new Batman();
print "Superman's starting health is ".$superman->getHealth()."<br />";
print "Batman's starting health is ".$batman->getHealth()."<br />";
print " -----------------------------------------------------------"."<br />";


while ($superman->getHealth() > 0 && $batman->getHealth() > 0) {
    echo "Batman's health is " . $batman->getHealth()."<br />";
    $batMandDmg = $superman->Attack($batman);
    echo "Batman was hit for ".$batMandDmg." point of damage!"."<br />";
    $batman->isDead();
    echo "Superman's health is " . $superman->getHealth()."<br />";
    $supermanDmg = $batman->Attack($superman);
    echo "Superman was hit for ".$supermanDmg." point of damage!"."<br />";
    $superman->isDead();

}
?>
</body>
</head>
</html>


