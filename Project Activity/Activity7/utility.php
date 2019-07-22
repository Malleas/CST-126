<?php

require_once('myFuncs.php');


function getAllUsers()
{
    $conn = dbConnect();
    $getQuery = "SELECT ID, FIRST_NAME, LAST_NAME from users";
    $results = $conn->query($getQuery);
    $users = array();
    $index = 0;
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $users[$index] = array($row["ID"], $row["FIRST_NAME"], $row["LAST_NAME"]);
            $index++;
        }
        return $users;
    } else {
        echo "0 results found";
    }

}

//Add a new function, getUsersByFirstName() in utilty.php that searches for users first name with the specified pattern
// passed as an argument to the function and returns the results in the 2 dimensional array like getAllUsers().
// If not results are found return null

function getUserByFirstName($searchPattern){
    $conn = dbConnect();
    $sql = "select * from activities.users where FIRST_NAME like '%$searchPattern%'";
    $results = mysqli_query($conn, $sql) or die (mysqli_error());
    $users = array();
    $index = 0;
    if($results->num_rows > 0){
        while ($row = $results->fetch_assoc()){
            $users[$index] = array($row['ID'], $row['FIRST_NAME'], $row['LAST_NAME'] );
            $index++;
        }
        return $users;
    }else {
        return null;
    }
}

function insertUsers(){

    $users = array(
        array("Jake", "Qwerty", "Qwerty", "Password1"),
        array("Blake", "Craft", "Crafty", "Password1"),
        array("Jennifer", "Craig", "Jenni", "Password1"),
    );
    for($i = 0; $i < count($users); $i++){
        $fName = $users[$i][0];
        $lName = $users[$i][1];
        $userName = $users[$i][2];
        $password = $users[$i][3];
        $conn = dbConnect();
        $sql = "Insert into activities.users(FIRST_NAME, LAST_NAME, USERNAME, PASSWORD) values ('$fName', '$lName', '$userName', '$password')";
        mysqli_query($conn, $sql)or die(mysqli_error());


    }


}


dbConnect()->close();



