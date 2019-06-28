<!--reference for blog template found @ https://www.w3schools.com/howto/howto_css_blog_layout.asp-->

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
            float: left;
            width: 25%;
            padding-left: 20px;
        }

        .fakeimg {
            background-image: url(images/profilePic.png);
            width: 200px;
            padding: 20px;
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

        .footer {
            padding: 20px;
            text-align: center;
            background: #ddd;
            margin-top: 20px;
        }

    </style>
</head>
<body>
<?php
//db connection
$conn = new mysqli('localhost', 'testUser', 'cst126pass', 'cst126milestone');
if (mysqli_connect_errno()) {
    echo "<p>Error: Could not connect to database.<br/> Please try again later.</p>";
    exit;
}
//DB Select posts
$sql = "SELECT * FROM posts ORDER BY post_date DESC";
$results = mysqli_query($conn, $sql) or die(mysqli_errno());

//logic to grab the top three rows in the posts DB to always display the top three posts based on date.
if ($results->num_rows > 0) {
    $row = $results->fetch_assoc();
    $row2 = $results->fetch_assoc();
    $row3 = $results->fetch_assoc();


    ?>
    <div class="header">
        <h2>Ratchet Paint Studio</h2>
    </div>

    <div class="row">
        <div class="leftcolumn">
            <div class="card">
                <h2><?php echo $row['post_title'] ?></h2>
                <h5><?php echo $row['post_date'] ?></h5>
                <p><?php echo $row['post_content'] ?></p>
            </div>
            <div class="card">
                <h2><?php echo $row2['post_title'] ?></h2>
                <h5><?php echo $row2['post_date'] ?></h5>
                <p><?php echo $row2['post_content'] ?></p>
            </div> <div class="card">
                <h2><?php echo $row3['post_title'] ?></h2>
                <h5><?php echo $row3['post_date'] ?></h5>
                <p><?php echo $row3['post_content'] ?></p>
            </div>
        </div>
        <div class="rightColumn">
            <div class="card">
                <h2>About Me</h2>
                <div class="fakeimg" style="height:200px;"></div>
                <p>Some text about me and stuff</p>
            </div>
            <div class="card">
                <h3>Popular Posts</h3>
                <h2><?php echo $row['post_title'] ?></h2>
                <br>
                <h2><?php echo $row2['post_title'] ?></h2>
                <br>
                <h2><?php echo $row3['post_title'] ?></h2>
            </div>
            <div class="card">
                <button onclick="window.location.href = 'createPost.html'" style="width:100%;">New</button>
            </div>
            <div class="card" align="center">
                <img src="images/facebook.png" height="100" width="100">
                <img src="images/instagram.jpg" height="100" width="100">
            </div>
        </div>
    </div>

    <div class="footer">
        <h2>Footer</h2>
    </div>
    <?php


} else {
    echo "There are not posts to display";
}
$conn->close();
?>


</body>

</html>