<?php
/**
 * All files are created and authored by Matt Sievers
 * File Header added on 7/22/19 6:30 PM
 * searchHandler.php
 * $projectName
 */

/**
 * All files are created and authored by Matt Sievers
 * File Header added on 7/22/19 6:29 PM
 * searchHandler.php
 * $projectName
 */

require_once('utility.php');

$searchPattern = $_POST['searchBox'];
$users = getUserByFirstName($searchPattern);
if($users != null){
    include ('_displayUsers.php');
}else{
    echo "Error, no records found.";
}


