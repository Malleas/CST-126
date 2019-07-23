<!--
All files authored by Matt Sievers
Date update 07/22/19
searchResults.php
CST-126/Milestone
reference for blog template found @ https://www.w3schools.com/howto/howto_css_blog_layout.asp
-->
<?php
require_once('database.php');
require_once('utils.php');
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
            font-size: 40px;
            text-align: center;
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
    <h2>Search Results</h2>
</div>
<div class="row">
    <div class="rightColumn">
        <div class="card">
            <button onclick="window.location.href = 'getContent.php'" style="width:100%;">Blog Home</button>
        </div>
    </div>

    <?php

    $conn = dbConnect();
    $searchParam = $_POST['searchBox'];
    $posts = getPostBySearchParam($searchParam);


    ?>
    <div class="leftcolumn">
        <?php

        for ($i = 0; $i < count($posts); $i++) {
            $id = $posts[$i][0];
            ?>

            <div class="card">
                <h2><?php echo $posts[$i][1] ?></h2>
                <h5><?php echo $posts[$i][2] ?></h5>
                <p><?php echo $posts[$i][3] ?> </p>
            </div>
            <?php
        }
        ?>
    </div>
</div>


</body>

</html>