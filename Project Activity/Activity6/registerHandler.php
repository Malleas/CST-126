<?php
require 'myFuncs.php';
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$userName = $_POST['userName'];
$password = $_POST['password'];
$hostName = 'localhost';
$dbUserName = 'testUser';
$dbPass = 'cst126pass';
$dbName = 'activity1';

//check to see if variables are blank

if (!isset($firstName) || trim($firstName) == '') {
    echo "First Name is required, please try again.<br />";
}
if (!isset($lastName) || trim($lastName) == '') {
    echo "Last Name is required, please try again.<br />";
}
if (!isset($userName) || trim($userName) == '') {
    echo "User Name is required, please try again.<br />";
}
if (!isset($password) || trim($password) == '') {
    echo "Password is required, please try again.<br />";
}

$conn = dbConnect($hostName, $dbUserName, $dbPass, $dbName);
$query = "INSERT INTO users (FIRST_NAME, LAST_NAME, USERNAME, PASSWORD) VALUES('$firstName', '$lastName', '$userName', '$password')";

if (mysqli_query($conn, $query)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

