<?php
require_once('utility.php');

$searchPattern = $_POST['searchBox'];
$users = getUserByFirstName($searchPattern);
if($users != null){
    include ('_displayUsers.php');
}else{
    echo "Error, no records found.";
}


