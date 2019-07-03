<?php

require_once ('database.php');

function getPosts(){
    $conn = dbConnect();
    $sql = "SELECT * FROM posts WHERE cst126milestone.posts.post_accepted like 1 ORDER BY post_date DESC";
    $results = mysqli_query($conn, $sql) or die(mysqli_error());
    $posts = array();
    $index = 0;
    if($results->num_rows > 0){
        while ($row = $results->fetch_assoc()){
            $posts[$index] = array($row['post_id'], $row['post_title'], $row['post_date'], $row['post_content']);
            $index++;
        }
        return $posts;
    }else{
        header("Location:createPost.html");
    }
}

function getUnapprovedPosts(){
    $conn = dbConnect();
    $sql = "SELECT * FROM posts WHERE cst126milestone.posts.post_accepted like 0 ORDER BY post_date DESC";
    $results = mysqli_query($conn, $sql) or die(mysqli_error());
    $posts = array();
    $index = 0;
    if($results->num_rows > 0){
        while ($row = $results->fetch_assoc()){
            $posts[$index] = array($row['post_id'], $row['post_title'], $row['post_date'], $row['post_content']);
            $index++;
        }
        return $posts;
    }else if($results->num_rows == 0){
        header("Location:getContent.php");
    }
}


dbConnect()->close();