<?php


class Superhero
{
private $name;
private $health;
private $isDead;

public function Attack(){
$damage = random_int(0,10);
$this->DetermineHealth($damage);
return $damage;
}

public function DetermineHealth($damage){
    $currentHealth = $this->getHealth();
    $afterDmgHealth = $currentHealth - $damage;
    $this->setHealth($afterDmgHealth);
    if($this->getHealth() > 0){
        $this->setIsDead(FALSE);
    }else {
        $this->setIsDead(TRUE);
    }
}

public function isDead(){
    if($this->getIsDead() == true){
        echo $this->getName()." is dead!"."<br />";
    }else {
        echo $this->getName()." fights on!"."<br />";
    }
}

    /**
     * Superhero constructor.
     * @param $name
     * @param $health
     */
    public function __construct($name, $health)
    {
        $this->name = $name;
        $this->health = $health;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @return mixed
     */
    public function getIsDead()
    {
        return $this->isDead;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $health
     */
    public function setHealth($health)
    {
        $this->health = $health;
    }

    /**
     * @param mixed $isDead
     */
    public function setIsDead($isDead)
    {
        $this->isDead = $isDead;
    }


}