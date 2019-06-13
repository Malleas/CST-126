<?php
$servername = "localhost";
$username = "testUser";
$password = "cst126pass";
$dbname = "users";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn -> connect_error){
    die("Connection failed: " .$conn->connect_error);
}

$sql = "CREATE TABLE Roles(
    role_id INT(6) UNIQUE NOT NULL,
    PRIMARY KEY (role_id)
)";

$sql = "CREATE TABLE Users (
user_id INT(6) AUTO_INCREMENT,
user_name VARCHAR (30) UNIQUE  NOT NULL,
user_role VARCHAR (10) DEFAULT NOT NULL,
user_nickname VARCHAR(30) UNIQUE NOT NULL,
first_name VARCHAR(30) NOT NULL,
middle_name VARCHAR(30),
last_name VARCHAR(30) NOT NULL,
email1 VARCHAR(60) UNIQUE NOT NULL,
email2 VARCHAR(60) unique NOT NULL,
address1 VARCHAR(60) NOT NULL,
address2 VARCHAR(60) NOT NULL,
city VARCHAR(30) NOT NULL,
state VARCHAR(30) NOT NULL,
zipcode INT(5) NOT NULL,
country varchar(30) NOT NULL,
user_banned BOOLEAN DEFAULT ('n'),
user_deleted BOOLEAN default ('n'),
PRIMARY KEY (user_id)


)";

if ($conn->query($sql) === TRUE){
    echo "Table Users created successfully";
}else{
    echo "Error creating table:" .$conn->error;
}

$conn->close();

?>