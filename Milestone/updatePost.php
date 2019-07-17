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
    <?php
    require_once('database.php');
    require_once('utils.php');
    $conn = dbConnect();


    if (isset($_POST['updateID'])) {
        $postId = $_POST['updateID'];
        $updatedTitle = $_POST['title'];
        $updatedContent = $_POST['content'];
        $updateSql = "update posts set post_title = '$updatedTitle', cst126milestone.posts.post_content = '$updatedContent' where cst126milestone.posts.post_id = '$postId'";
        mysqli_query($conn, $updateSql) or die (mysqli_error());
        header("Location:getContent.php");
        exit;
    } else {
        $postId = $_POST['id'];
        $sql = "Select * from cst126milestone.posts where post_id = '$postId'";
        $results = mysqli_query($conn, $sql) or die(mysqli_error());
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $title = $row['post_title'];
                $content = $row['post_content'];
            }
        }

        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <input placeholder="Title" name="title" type="text" value="<?php echo $title ?>" autofocus
                   size="48"><br/><br/>
            <textarea placeholder="Content" name="content" rows="20" cols="50"><?php echo $content ?></textarea><br/>
            <input type="hidden" name="updateID" value="<?php print $postId; ?>">
            <input name="post" type="submit" value="Update">
        </form>

        <?php

    }

    ?>


</div>

<?php $conn->close(); ?>

</body>
</html>