<?php

function dbConnect()
{
    $dbConn = new mysqli('cst126milestone-mysqldbserver.mysql.database.azure.com', 'mysqldbuser@cst126milestone-mysqldbserver', 'cst126Pass', 'cst126milestone');
    if ($dbConn->connect_error) {
        die("Connection failed: " . $dbConn->connect_error);
    }
    return $dbConn;
};