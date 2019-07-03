<?php
require_once ('database.php');
// Setting variables needed
$title = $_POST['title'];
$content = $_POST['content'];

// check to ensure both title and post are not empty.
if($title == "" || $content == ""){
    echo "Please complete your post.";
    exit;
}
/*
ref for this found @ https://stackoverflow.com/questions/28656642/php-trying-to-check-if-users-input-does-not-contain-banned-words
Check to see if any of the forbidden words exist in the content.  Splitting the content to a new array and then comparying
it to the prohibited_word list.
*/
$prohibited_words = array('hello', 'stuff', 'cat');
$input_array = explode(' ', strtolower($content));
$intersect = array_intersect($prohibited_words, $input_array);

if(!empty($intersect)){
    foreach ($intersect as $item) {
        echo "$item"." Is a banned word, please update your post.<br/>";
    }
    die();
}


//db connection
$conn = dbConnect();
$sql = ("INSERT into posts (post_title, post_content) VALUES ('$title', '$content')");


//check to make sure data is saved to the DB otherwise throw an error.
if (mysqli_query($conn, $sql)) {
    header("Location: getContent.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
//close DB
$conn->close();









