<?php
require_once ('Superhero.php');

class Batman extends Superhero
{
    function __construct()
    {
        parent::__construct("Batman", random_int(1, 1000));
    }
}

