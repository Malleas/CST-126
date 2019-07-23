<?php
/**
 * All files are created and authored by Matt Sievers
 * File Header added on 7/22/19 6:30 PM
 * Superman.php
 * $projectName
 */

/**
 * All files are created and authored by Matt Sievers
 * File Header added on 7/22/19 6:29 PM
 * Superman.php
 * $projectName
 */

require_once ('Superhero.php');

class Superman extends Superhero
{
    function __construct()
    {
        parent::__construct("Superman", random_int(1, 1000));
    }
}
