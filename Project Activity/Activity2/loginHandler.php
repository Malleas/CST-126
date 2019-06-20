<?php

$userName = $_POST['userName'];
$password = $_POST['password'];

if (!isset($userName) || trim($userName) == '') {
    echo "User Name is required, please try again.<br />";
}
if (!isset($password) || trim($password) == '') {
    echo "Password is required, please try again.<br />";
}

$dbConn = new mysqli('localhost', 'testUser', 'cst126pass', 'activity1');
if($dbConn->connect_error){
    die("Connection failed: " .$dbConn->connect_error);
}

$loginQuery = "SELECT * FROM users WHERE USERNAME = '$userName' && PASSWORD = '$password'";
$results = $dbConn->query($loginQuery);

if ($results->num_rows == 1){
        echo "Login Successful!";
}else if($results->num_rows == 0){
    echo "Login Failed!";
}else if($results->num_rows > 1){
    echo "There are multiple users have registered";
}else{
    echo "Connection Error: ".$dbConn->connect_error;
}

mysqli_close($dbConn);
?>