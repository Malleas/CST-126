<?php
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$dbConn = new mysqli('localhost', 'testUser', 'cst126pass', 'activity1');
$query = "INSERT INTO users (FIRST_NAME, LAST_NAME) VALUES('$firstName', '$lastName')";

if (mysqli_query($dbConn, $query)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($dbConn);
}

mysqli_close($dbConn);

