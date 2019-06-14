<!DOCTYPE html>
<html>
<head>
    <title>Create New User Completion</title>
</head>
<body>
<h1>New User Created Results</h1>
<?php


$dbUserName = 'testUser';
$dbPass = 'cst126pass';
$dbName = 'cst126milestone';

$firstName = $_POST['First Name'];
$middleName = $_POST['Middle Name'];
$lastName = $_POST['Last Name'];
$nickName = $_POST['Nick Name'];
$userName = $_POST['User Name'];
$address1 = $_POST['Address1'];
$address2 = $_POST['Address2'];
$email1 = $_POST['Email'];
$email2 = $_POST['Alternate Email'];
$city = $_POST['City'];
$state = $_POST['State'];
$zipCode = $_POST['ZipCode'];
$country = $_POST['Country'];
$userRole = $_POST['User Role'];
$userRoleId = 0;

if (!isset($_POST['First Name']) || !isset($_POST['Last Name'])
    || !isset($_POST['Email']) || !isset($_POST['User Role']) || !isset($_POST['User Name'])) {
    echo "<p>You have not entered all required fields, <br />
    Please try again.</p>";
    exit;
}


if (!$nickName){
    $nickName = $firstName+$lastName;
}
if($userRole === "Writer"){
    $userRoleId = 1;
}else{
    $userRoleId = 2;
}



$db = new mysqli('localhost', $dbUserName, $dbPass, $dbName);
if (mysqli_connect_error()) {
    echo '<p> Error: Could not connect to database. <br />
    Please try again later.</p>';
    exit;
}

$createUserQuery = "INSERT INTO $dbName VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$stmt = $db->prepare($createUserQuery);
$stmt->bind_param('sssssssssssisi', $firstName, $middleName, $lastName,
$nickname, $userName, $email1, $email2, $address1, $address2, $city, $state, $zipCode, $country, $userRoleId);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "<p> User created successfully.</p>";
}else{
    echo "<p> An error has occured. <br />
    The item was not added.</p>p";
}

$db->close();

?>
</body>
</html>


