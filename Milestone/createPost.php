<!--
All files authored by Matt Sievers
Date update 07/22/19
createPost.php
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
<div class="card">
    <form action="" method="post" enctype="multipart/form-data">
        <?php
        session_start();
        require_once('utils.php');
        if (isset($_POST['post'])){
            $title = $_POST['title'];
            $content = $_POST['content'];
            $id = $_SESSION['id'];
            $userName = $_SESSION['userName'];
            if ($title == "" || $content == "") {
                echo "Please complete your post.";
            }else{
                checkPostForProhibitedWords($content);
                createPost($title, $content, $userName);
                header("Location:getContent.php");
                exit;
            }
        }

        ?>
        <input placeholder="Title" name="title" type="text" autofocus size="48"><br/><br/>
        <textarea placeholder="Content" name="content" rows="20" cols="50"></textarea><br/>
        <input name="post" type="submit" value="Post">
    </form>
</div>

</body>
</html>












