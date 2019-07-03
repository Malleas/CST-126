<?php
require 'myFuncs.php';
$userName = $_POST['userName'];
$password = $_POST['password'];
$hostName = 'localhost';
$dbUserName = 'testUser';
$dbPass = 'cst126pass';
$dbName = 'activity1';
$message = "";


if (!isset($userName) || trim($userName) == '') {
    echo "User Name is required, please try again.<br />";
}
if (!isset($password) || trim($password) == '') {
    echo "Password is required, please try again.<br />";
}

$conn = dbConnect($hostName, $dbUserName, $dbPass, $dbName);

$loginQuery = "SELECT * FROM users WHERE USERNAME = '$userName' && PASSWORD = '$password'";
$results = $conn->query($loginQuery);

if ($results->num_rows == 1) {
    $row = $results->fetch_assoc();
    saveUserId($row["ID"]);
    include('loginResponse.php');
} else if ($results->num_rows == 0) {
    $message = "Login Failed!";
    include('loginFailed.php');
} else if ($results->num_rows > 1) {
    $message = "There are multiple users have registered";
    include('loginFailed.php');
} else {
    echo "Connection Error: " . $conn->connect_error;
}

mysqli_close($conn);
?>