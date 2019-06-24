<?php

function dbConnect()
{
    $dbConn = new mysqli('localhost', 'testUser', 'cst126pass', 'activity1');
    if ($dbConn->connect_error) {
        die("Connection failed: " . $dbConn->connect_error);
    }
    return $dbConn;
}

;

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