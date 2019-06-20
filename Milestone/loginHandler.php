<?php

//assign variables from POST
$userName = $_POST['userName'];
$password = $_POST['password'];
$ip = $_SERVER['REMOTE_ADDR'];

//check variables have not been left blank, otherwise throw error
if (!isset($userName) || trim($userName) == '') {
    echo "User Name is required, please try again.<br />";
    exit;
}

if (!isset($password) || trim($password) == '') {
    echo "Password is required, please try again.<br />";
    exit;
}

//create DB Connection
$dbConn = new mysqli('localhost', 'testUser', 'cst126pass', 'cst126milestone');
if (mysqli_connect_errno()) {
    echo "<p>Error: Could not connect to database.<br/> Please try again later.</p>";
    exit;
}


//Query to use inputs from POST to see if the user exists and the password is correct.
$loginQuery = "SELECT * FROM user_info WHERE userName = '$userName'";
$results = $dbConn->query($loginQuery);
$rowCount = mysqli_num_rows($results);

//capture IP for # of attempts.  ref @ https://stackoverflow.com/questions/37120328/how-to-limit-the-number-of-login-attempts-in-a-login-script
mysqli_query($dbConn, "INSERT INTO ip (ip, timestamp) VALUES ('$ip', CURRENT_TIMESTAMP)");
$result = mysqli_query($dbConn, "SELECT COUNT(*) FROM ip WHERE `ip` LIKE '$ip' AND `timestamp` > (now() - interval 10 minute)");
$count = mysqli_fetch_array($result, MYSQLI_NUM);

// Check to see if password given from POST is the password in the DB
if($rowCount == 1){
    $queryPassword = "SELECT password from user_info WHERE userName = '$userName'";
    $passwordResults = $dbConn->query($queryPassword);
    //change resource of results to a string value to validate password
    $row = mysqli_fetch_array($passwordResults, MYSQLI_ASSOC);
    $hash = $row['password'];
    $loginAttempts = 0;
    //Check to see if password given matches, if not 3 attempts al given before error disallowing attempts.
    if(password_verify($password, $hash)){
        sleep(1);
        echo '<script>window.location = "homePage.html"</script>';
    }else if($count[0] <= 3){
        echo "Login failed, please try again <br />";
        echo '<button onclick="window.location.href = \'login.html\'">Try Again</button>';
    }else if($count[0] > 3){
        echo "Your are allowed 3 attempts in 10 minutes";
    }
}

//close DB connection
mysqli_close($dbConn);


