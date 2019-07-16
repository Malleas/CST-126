<?php
require_once ('Superhero.php');

class Superman extends Superhero
{
    function __construct()
    {
        parent::__construct("Superman", random_int(1, 1000));
    }
}
