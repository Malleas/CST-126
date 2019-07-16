<html>
<head>
<body>
<?php
require_once('Superman.php');
require_once('Batman.php');

print random_int(1,50);

$superman = new Superman();
$batman = new Batman();
print $superman->getHealth();
print $batman->getHealth();


if ($superman->getHealth() < 0 && $batman->getHealth() < 0) {
    $superman->Attack($batman);
    $batman->DetermineHealth();
    echo "Batman's health is " . $batman->getHealth();
    $batman->isDead();
    $batman->Attack($superman);
    $superman->DetermineHealth();
    echo "Batman's health is " . $superman->getHealth();
    $superman->isDead();

}
?>
</body>
</head>
</html>


