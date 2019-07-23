<?php
/**
 * All files are created and authored by Matt Sievers
 * File Header added on 7/22/19 6:30 PM
 * registerHandler.php
 * $projectName
 */

/**
 * All files are created and authored by Matt Sievers
 * File Header added on 7/22/19 6:29 PM
 * registerHandler.php
 * $projectName
 */

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$userName = $_POST['userName'];
$password = $_POST['password'];

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

$dbConn = new mysqli('localhost', 'testUser', 'cst126pass', 'activity1');
$query = "INSERT INTO users (FIRST_NAME, LAST_NAME, USERNAME, PASSWORD) VALUES('$firstName', '$lastName', '$userName', '$password')";

if (mysqli_query($dbConn, $query)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($dbConn);
}

mysqli_close($dbConn);

