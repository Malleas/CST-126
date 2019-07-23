<!--
All files authored by Matt Sievers
Date update 07/22/19
comment.php
CST-126/Milestone
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial;
            padding: 20px;
            background: #f1f1f1;
        }

        .card {
            background-color: white;
            margin: 0 auto;
            width: 1000px;
            height: 350px;
            padding: 20px;
        }

        textarea {
            width: 100%;
            height: 250px;
            padding: 20px 20px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            resize: none;
        }

        input {
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            resize: none;
        }


    </style>

</head>
<body>
<?php
session_start();
$postId = $_POST['id'];
require_once ('utils.php');
if(isset($_POST['post'])){
    $orgPostId = $_POST['orgPostId'];
    $commentContent = $_POST['content'];
    if($commentContent == ''){
        echo "Please complete your post.";
    }else {
        createComment($commentContent, $orgPostId);
        header("Location:getContent.php");
        exit;
    }


}
?>
<div class="card">
    <form action="" method="post" enctype="multipart/form-data">
        <textarea placeholder="Content" name="content" rows="20" cols="50"></textarea><br/>
        <input type="hidden" name="orgPostId" value="<?php print $postId?>">
        <input name="post" type="submit" value="Comment">
    </form>
</div>


</body>
</html>