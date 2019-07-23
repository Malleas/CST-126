<?php
/**
 * All files are created and authored by Matt Sievers
 * File Header added on 7/22/19 6:30 PM
 * Batman.php
 * $projectName
 */

/**
 * All files are created and authored by Matt Sievers
 * File Header added on 7/22/19 6:29 PM
 * Batman.php
 * $projectName
 */

require_once ('Superhero.php');

class Batman extends Superhero
{
    function __construct()
    {
        parent::__construct("Batman", random_int(1, 1000));
    }
}

