<?php

function dbConnect(){
    $dbConn = new mysqli('localhost', 'testUser', 'cst126pass', 'activity1');
    if ($dbConn->connect_error) {
        die("Connection failed: " . $dbConn->connect_error);
    }
    return $dbConn;
}