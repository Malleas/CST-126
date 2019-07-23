<!--
All files authored by Matt Sievers
Date update 07/22/19
viewComments.php
CST-126/Milestone
reference for blog template found @ https://www.w3schools.com/howto/howto_css_blog_layout.asp
-->
<?php
require_once('utils.php');
require_once ('database.php');
$postId = $_POST['id'];
?>
<!DOCTYPE html>
<html>
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

        .header {
            padding: 30px;
            text-align: left;
            background: white;
        }

        .leftcolumn {
            float: left;
            width: 75%;
        }

        .rightColumn {
            float: right;
            width: 25%;
            padding-left: 20px;
        }

        .card {
            background-color: white;
            padding: 20px;
            margin-top: 20px;
        }

        .row:after {
            content: '';
            display: table;
            clear: both;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Original Post</h1>
    <?php
    $conn = dbConnect();
    $sql = "select * from posts where post_id = '$postId'";
    $results = mysqli_query($conn, $sql) or die (mysqli_error());
    if($results->num_rows > 0){
        while($rows = $results->fetch_assoc()){
            $title = $rows['post_title'];
            $date = $rows['post_date'];
            $content = $rows['post_content'];
            ?>
            <h2><?php echo $title ?></h2>
            <h5><?php echo $date ?></h5>
            <p><?php echo $content ?> </p>
            <?php
        }
    }

    ?>

</div>
<div class="row">
    <div class="rightColumn">
        <div class="card">
            <button onclick="window.location.href = 'getContent.php'" style="width:100%;">Blog Home</button>
        </div>
    </div>
    <?php
    session_start();
    $id = $_SESSION['id'];
    $userName = $_SESSION['userName'];
    $comments = getComments($postId);

    ?>
    <div class="leftcolumn">
        <div class="card">
            <h2 align="center">Comments</h2>
        </div>
        <?php

        for ($i = 0; $i < count($comments); $i++) {
            ?>

            <div class="card">
                <h5><?php echo $comments[$i][1] ?></h5>
                <p><?php echo $comments[$i][2] ?> </p>
            </div>
            <?php
        }
        ?>
    </div>
</div>


</body>

</html>