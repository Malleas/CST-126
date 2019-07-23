<?php
/**
 * All files are created and authored by Matt Sievers
 * File Header added on 7/22/19 6:30 PM
 * myFuncs.php
 * $projectName
 */

/**
 * All files are created and authored by Matt Sievers
 * File Header added on 7/22/19 6:29 PM
 * myFuncs.php
 * $projectName
 */

function dbConnect()
{
    $dbConn = new mysqli('cst126activities-mysqldbserver.mysql.database.azure.com', 'testUser@cst126activities-mysqldbserver', 'cst126Password', 'activities');
    if ($dbConn->connect_error) {
        die("Connection failed: " . $dbConn->connect_error);
    }
    return $dbConn;
};

function saveUserId($id)
{
    session_start();
    $_SESSION["USER_ID"] = $id;
}

function getUserId()
{
    session_start();
    return $_SESSION["USER_ID"];
}