<?php
$dbConn = new mysqli('localhost', 'testUser', 'cst126pass', 'activity1');
if($dbConn->connect_error){
    die("Connection failed: " .$dbConn->connect_error);
}

$getQuery = "SELECT * from users";
$results = $dbConn->query($getQuery);

if ($results->num_rows > 0){
    while ($row = $results->fetch_assoc()){
        echo "id: ".$row['ID']." - First Name: ".$row['FIRST_NAME']." - Last Name: ".$row['LAST_NAME']."<br>";
    }
}else{
    echo "0 results found";
}

$dbConn->close();