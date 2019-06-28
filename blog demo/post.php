<?php
session_start();
include_once('db.php');

if (isset($_POST['post'])) {
    $title = strip_tags($_POST['title']);
    $content = strip_tags($_POST['content']);

    $title = mysqli_real_escape_string($db, $title);
    $content = mysqli_real_escape_string($db, $content);

    $date = date('l js \of F Y h:i:s A');

    $sql = "INSERT into posts (post_title, post_content, post_date) VALUES ('$title', '$content', '$date')";

    if ($title == "" || $content == "") {
        echo "Please complete your post";
        return;
    }

    mysqli_query($db, $sql);

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog - Post</title>
</head>
<body>
<form action="post.php" method="post" enctype="multipart/form-data">
    <input placeholder="Title" name="title" type="text" autofocus size="48"><br/><br/>
    <textarea placeholder="Content" name="content" rows="20" cols="50"></textarea><br/>
    <input name="post" type="submit" value="Post">
</form>
</body>
</html>

