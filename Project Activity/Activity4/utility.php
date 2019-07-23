<?php
/**
 * All files are created and authored by Matt Sievers
 * File Header added on 7/22/19 6:30 PM
 * utility.php
 * $projectName
 */

/**
 * All files are created and authored by Matt Sievers
 * File Header added on 7/22/19 6:29 PM
 * utility.php
 * $projectName
 */

require_once('myFuncs.php');


function getAllUsers()
{
    $conn = dbConnect();
    $getQuery = "SELECT ID, FIRST_NAME, LAST_NAME from users";
    $results = $conn->query($getQuery);
    $users = array();
    $index = 0;
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $users[$index] = array($row["ID"], $row["FIRST_NAME"], $row["LAST_NAME"]);
            $index++;
        }
        return $users;
    } else {
        echo "0 results found";
    }

}


dbConnect()->close();



