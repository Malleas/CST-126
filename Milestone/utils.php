<?php
/**
 * All files are created and authored by Matt Sievers
 * File Header added on 7/22/19 6:30 PM
 * utils.php
 * $projectName
 */


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
        header("Location:createPost.php");
    }
}

function getComments($postId)
{
    $conn = dbConnect();
    $sql = "SELECT * FROM comments WHERE post_id = '$postId'  ORDER BY comment_date DESC";
    $results = mysqli_query($conn, $sql) or die(mysqli_error());
    $comments = array();
    $index = 0;
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $comments[$index] = array($row['comment_id'], $row['comment_date'], $row['comment_content']);
            $index++;
        }
        return $comments;
    } else {
        echo "No comments available.";
    }
}

function getCommentCount($postId)
{
    $conn = dbConnect();
    $sql = "select count(*) as total from cst126milestone.comments where post_id = '$postId'";
    $results = mysqli_query($conn, $sql) or die (mysqli_error());
    $data = $results->fetch_assoc();
    return $data['total'];
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

function updatePost($updateId)
{
    $conn = dbConnect();
    $sql = "SELECT * FROM cst126milestone.posts where post_id = '$updateId'";
    $results = mysqli_query($conn, $sql) or die(mysqli_error());
    $updatePost = array();
    $index = 0;
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $updatePost[$index] = array($row['post_title'], $row['post_content']);
        }
        return $updatePost;
    } else if ($results->num_rows == 0) {
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

function getUserCount()
{
    $conn = dbConnect();
    $sql = "select count(*) as total from cst126milestone.user_info";
    $results = mysqli_query($conn, $sql) or die (mysqli_error());
    $data = $results->fetch_assoc();
    return $data['total'];
}

function getDeletedUsersCount()
{
    $conn = dbConnect();
    $sql = "select count(*) as total from cst126milestone.user_info where userDeleted = 'y'";
    $results = mysqli_query($conn, $sql) or die (mysqli_error());
    $data = $results->fetch_assoc();
    return $data['total'];
}

function getPostsCount()
{
    $conn = dbConnect();
    $sql = "select count(*) as total from cst126milestone.posts";
    $results = mysqli_query($conn, $sql) or die (mysqli_error());
    $data = $results->fetch_assoc();
    return $data['total'];
}

function getBannedUsers()
{
    $conn = dbConnect();
    $sql = "select count(*) as total from cst126milestone.user_info where userBanned = 'y' ";
    $results = mysqli_query($conn, $sql) or die (mysqli_error());
    $data = $results->fetch_assoc();
    return $data['total'];
}

function getPostBySearchParam($searchParam)
{
    $conn = dbConnect();
    $sql = "select * from cst126milestone.posts where cst126milestone.posts.post_accepted like 1 and post_title like '%$searchParam%' or post_content like '%$searchParam%' order by post_date desc ";
    $results = mysqli_query($conn, $sql) or die (mysqli_error());
    $posts = array();
    $index = 0;
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $posts[$index] = array($row['post_id'], $row['post_title'], $row['post_date'], $row['post_content']);
            $index++;
        }
        return $posts;
    } else {
        echo "No posts found matching your search.";
    }
}

function runComplianceCheck($userName)
{
    $conn = dbConnect();
    $msg = "You are below the post minimum, please post again to ensure compliance.";
    $sql = "select count(*) as total from cst126milestone.posts where cst126milestone.posts.post_author = '$userName'";
    $results = mysqli_query($conn, $sql) or die(mysqli_error());
    $data = $results->fetch_assoc();
    if ($data['total'] < 2) {
        echo "Email sent to '$userName'";
        mail("msievers@my.gcu.edu", "Out of compliance", $msg);
    } else {
        echo $userName . " is in complaince, no action required.";
    }
}

function checkPostForProhibitedWords($content)
{
    /*
    ref for this found @ https://stackoverflow.com/questions/28656642/php-trying-to-check-if-users-input-does-not-contain-banned-words
    Check to see if any of the forbidden words exist in the content.  Splitting the content to a new array and then comparying
    it to the prohibited_word list.
    */
    $prohibited_words = array('hello', 'stuff', 'cat');
    $input_array = explode(' ', strtolower($content));
    $intersect = array_intersect($prohibited_words, $input_array);

    if (!empty($intersect)) {
        foreach ($intersect as $item) {
            echo "$item" . " Is a banned word, please update your post.<br/>";
        }
        die();
    }
}

function createPost($title, $content, $userName)
{
    $conn = dbConnect();
    $sql = ("INSERT into posts (post_title, post_content, cst126milestone.posts.post_author) VALUES ('$title', '$content', '$userName')");
    mysqli_query($conn, $sql) or die(mysqli_error());
}

function updateRate($postId, $postValue)
{
    $conn = dbConnect();
    $sql = "insert into rate (rate, post_id) values ('$postValue', '$postId')";
    mysqli_query($conn, $sql) or die (mysqli_error());
}

function getRate($postId)
{
    $conn = dbConnect();
    $sql = "Select avg(rate) as avg from rate where post_id = '$postId'";
    $results = mysqli_query($conn, $sql) or die(mysqli_error());
    $data = $results->fetch_assoc();
    $avg = $data['avg'];
    $sql = "update cst126milestone.posts set post_rate = '$avg' where cst126milestone.posts.post_id = '$postId' ";
    mysqli_query($conn, $sql) or die(mysqli_error());
    return $avg;
}

function createComment($commentContent, $postId)
{
    $conn = dbConnect();
    $sql = "insert into comments(comment_content, post_id) values ('$commentContent', '$postId')";
    mysqli_query($conn, $sql) or die (mysqli_error());
}

function getHighestRatedPost()
{
    $conn = dbConnect();
    $sql = "select * from posts order by post_rate desc limit 10";
    $results = mysqli_query($conn, $sql) or die (mysqli_error());
    $posts = array();
    $index = 0;
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $posts[$index] = array($row['post_id'], $row['post_title'], $row['post_rate']);
            $index++;
        }
        return $posts;
    } else {
        echo "No posts are currently rated.";
    }

}


dbConnect()->close();