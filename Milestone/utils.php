<?php

require_once('database.php');

function getPosts()
{
    $conn = dbConnect();
    $sql = "SELECT * FROM posts WHERE cst126milestone.posts.post_accepted like 1 ORDER BY post_date DESC";
    $results = mysqli_query($conn, $sql) or die(mysqli_error());
    $posts = array();
    $index = 0;
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $posts[$index] = array($row['post_id'], $row['post_title'], $row['post_date'], $row['post_content']);
            $index++;
        }
        return $posts;
    } else {
        header("Location:createPost.html");
    }
}

function getUnapprovedPosts()
{
    $conn = dbConnect();
    $sql = "SELECT * FROM posts WHERE cst126milestone.posts.post_accepted like 0 ORDER BY post_date DESC";
    $results = mysqli_query($conn, $sql) or die(mysqli_error());
    $posts = array();
    $index = 0;
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $posts[$index] = array($row['post_id'], $row['post_title'], $row['post_date'], $row['post_content']);
            $index++;
        }
        return $posts;
    } else if ($results->num_rows == 0) {
        echo "There are no new posts pending approval";
    }
}

function updatePost($updateId){
    $conn = dbConnect();
    $sql = "SELECT * FROM cst126milestone.posts where post_id = '$updateId'";
    $results = mysqli_query($conn, $sql) or die(mysqli_error());
    $updatePost = array();
    $index = 0;
    if($results->num_rows > 0){
        while ($row = $results->fetch_assoc()){
            $updatePost[$index] = array($row['post_title'], $row['post_content']);
        }
        return $updatePost;
    }else if ($results->num_rows == 0){
        echo "No posts matching to update.";
    }
}

function getAllUsers()
{
    $conn = dbConnect();
    $sql = "SELECT * FROM cst126milestone.user_info ";
    $results = mysqli_query($conn, $sql) or die(mysqli_error());
    $users = array();
    $index = 0;
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $users[$index] = array($row['userId'], $row['userName'], $row['firstName'], $row['lastName'], $row['roleName']);
            $index++;
        }
        return $users;
    } else if ($results->num_rows == 0) {
        echo "There are no active users registered.";
    }
}

function getUserCount(){
    $conn = dbConnect();
    $sql = "select count(*) as total from cst126milestone.user_info";
    $results = mysqli_query($conn, $sql) or die (mysqli_error());
    $data = $results->fetch_assoc();
    return $data['total'];
}
function getDeletedUsersCount(){
    $conn = dbConnect();
    $sql = "select count(*) as total from cst126milestone.user_info where userDeleted = 'y'";
    $results = mysqli_query($conn, $sql) or die (mysqli_error());
    $data = $results->fetch_assoc();
    return $data['total'];
}
function getPostsCount(){
    $conn = dbConnect();
    $sql = "select count(*) as total from cst126milestone.posts";
    $results = mysqli_query($conn, $sql) or die (mysqli_error());
    $data = $results->fetch_assoc();
    return $data['total'];
}
function getBannedUsers(){
    $conn = dbConnect();
    $sql = "select count(*) as total from cst126milestone.user_info where userBanned = 'y' ";
    $results = mysqli_query($conn, $sql) or die (mysqli_error());
    $data = $results->fetch_assoc();
    return $data['total'];
}



dbConnect()->close();