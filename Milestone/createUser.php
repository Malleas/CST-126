<!DOCTYPE html>
<html>
<head>
    <title>Create New User Completion</title>
</head>
<body>
<h1>New User Created Results</h1>
<?php

//Creation of variables from POST
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
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);

//check to make sure password meets requirements  reference https://codereview.stackexchange.com/questions/173831/user-id-password-constraints-checker
if(!$uppercase || !$lowercase || !$number || !ctype_alnum($password) || strlen($password) < 8) {
    echo "The password must contain at least 1 lowercase letter, 1 uppercase letter and 1 number.<br />";
    echo "The password can't contain special symbols.<br />>";
    echo '<button onclick="window.location.href = \'userRegistrationPage.html\'">Try Again</button>';
    exit;
}

//Create a hash for password
$hashedPass = password_hash($password, PASSWORD_DEFAULT);
$hashedConfirmPassword = password_hash($confirmPassword, PASSWORD_DEFAULT);

// Check to see if passwords match as typed
if(password_verify($hashedConfirmPassword, $hashedPass)){
    echo "Passwords do not match, please ensure that the passwords are correct.<br />";
    exit;
}
//check to see if nick name is set, if not set it to firstName+lastName
if (empty($nickName)) $nickName = $firstName . $lastName;
//check to see that required fields are not left blank.
if (!isset($firstName) || trim($firstName) == '') {
    echo "First Name is required, please try again.<br />";
    exit;
}
if (!isset($lastName) || trim($lastName) == '') {
    echo "Last Name is required, please try again.<br />";
    exit;
}
if (!isset($userName) || trim($userName) == '') {
    echo "User Name is required, please try again.<br />";
    exit;
}
if (!isset($email1) || trim($email1) == '') {
    echo "Email is required, please try again.<br />";
    exit;
}
if (!isset($password) || trim($password) == '') {
    echo "Password is required, please try again.<br />";
    exit;
}
if (!isset($confirmPassword) || trim($confirmPassword) == '') {
    echo "Password confirmation required, please confirm password.<br />";
    exit;
}


// connect to DB
$db = new mysqli('localhost', 'testUser', 'cst126pass', 'cst126milestone');
if (mysqli_connect_errno()) {
    echo "<p>Error: Could not connect to database.<br/> Please try again later.</p>";
    exit;
}
// Query to insert records from userRegistrationPage -> user_info table
$query = "INSERT INTO user_info (userName, firstname, middleName, lastName, nickName, email1, email2, address1, 
                      address2, city, state, zipCode, country, password, confirmPassword) 
                      VALUES('$userName', '$firstName', '$middleName', '$lastName', '$nickName', '$email1', '$email2',
                             '$address1', '$address2', '$city', '$state', '$zipCode', '$country', 
                             '$hashedPass', '$hashedConfirmPassword')";
// execution of query with pass/fail msg.
if (mysqli_query($db, $query)) {
    echo "New record created successfully";
    header("Location: login.html");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($db);
}

// close DB connection
mysqli_close($db);

?>
</body>
</html>


