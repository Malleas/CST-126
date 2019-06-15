<!DOCTYPE html>
<html>
<head>
    <title>Create New User Completion</title>
</head>
<body>
<h1>New User Created Results</h1>
<?php

$userName = $_POST['userName'];
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
$nickName = $_POST['nickName'];
$email1 = $_POST['email1'];
$email2 = $_POST['email2'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipCode = $_POST['zipCode'];
$country = $_POST['country'];

if (empty($nickName)) $nickName = $firstName . $lastName;

if (!isset($firstName) || trim($firstName) == '') {
    echo "First Name is required, please try again.<br />";
}

if (!isset($lastName) || trim($lastName) == '') {
    echo "Last Name is required, please try again.<br />";
}

if (!isset($userName) || trim($userName) == '') {
    echo "User Name is required, please try again.<br />";
}

if (!isset($email1) || trim($email1) == '') {
    echo "Email is required, please try again.<br />";
}


$db = new mysqli('localhost', 'testUser', 'cst126pass', 'cst126milestone');
if (mysqli_connect_errno()) {
    echo "<p>Error: Could not connect to database.<br/> Please try again later.</p>";
    exit;
}
$query = "INSERT INTO user_info (userName, firstname, middleName, lastName, nickName, email1, email2, address1, 
                      address2, city, state, zipCode, country) 
                      VALUES('$userName', '$firstName', '$middleName', '$lastName', '$nickName', '$email1', '$email2',
                             '$address1', '$address2', '$city', '$state', '$zipCode', '$country')";

if (mysqli_query($db, $query)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($db);
}

mysqli_close($db);

?>
</body>
</html>


