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
<div class="header">
    <h2>Ratchet Paint Studio</h2>
</div>
<div class="row">
    <?php
    session_start();
    $userName = $_SESSION['userName'];
    $id = $_SESSION['userId'];
    require_once('utils.php');
    require_once('database.php');
    $conn = dbConnect();
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'Update') {
            if (isset($_POST['id'])) {
                header("Location:updatePost.php");
                exit;
            }else{
                echo "No post id set.";
            }
        } elseif ($_POST['action'] == 'Delete') {
            if (isset($_POST['id'])) {
                $deleteId = $_POST['id'];
                $sql = "delete from cst126milestone.posts where cst126milestone.posts.post_id = '$deleteId'";
                mysqli_query($conn, $sql) or die(mysqli_error());
                header("Refresh:0");
                exit;

            } else {

                echo "No post ID Set";
            }
        }

    } else {
        //additional error handling if needed.

    }

    ?>


    <div class="leftcolumn">
        <?php
        $posts = getPosts();
        for ($i = 0; $i < count($posts); $i++) {
            $postId = $posts[$i][0];
            ?>

            <div class="card">
                <h2><?php echo $posts[$i][1] ?></h2>
                <h5><?php echo $posts[$i][2] ?></h5>
                <p><?php echo $posts[$i][3] ?> </p>
                <?php
                $sql = "select cst126milestone.user_info.roleName from cst126milestone.user_info where userId = '$id'";
                $results = mysqli_query($conn, $sql) or die (mysqli_error());
                if ($results->num_rows > 0) {
                    while ($row = $results->fetch_assoc()) {
                        if ($row['roleName'] == 'Admin') {
                            ?>
                            <form method="post" action="updatePost.php"style="display: inline-block">
                                <input type="hidden" name="id" value="<?php print $postId ?>">
                                <input type="submit" id='Update' value="Update" name="action" class="Update"/>
                            </form>
                            <form method="post" action=""style="display: inline-block">
                                <input type="hidden" name="id" value="<?php print $postId ?>">
                                <input type="submit" id='Delete' value="Delete" name="action" class="Delete"/>
                            </form>


                            <?php
                        } else if ($row['roleName'] == 'Blogger') {
                            ?>
                            <form method="post" action="https://cst126milestone.azurewebsites.net/updatePost.php">
                                <input type="hidden" name="id" value="<?php print $postId ?>">
                                <input type="submit" id='Update' value="Update" name="action" class="Update"/>
                            </form>
                            <?php
                        }
                    }

                }
                ?>
            </div>
            <?php
        }
        ?>
    </div>


    <div class="rightColumn">
        <div class="card">
            <h2>About Me</h2>
            <div class="fakeimg" style="height:200px;"></div>
            <p>Some text about me and stuff</p>
        </div>
        <h3>Popular Posts</h3>
        <div class="card">
            <?php
            for ($i = 0; $i < count($posts); $i++) {
                ?>
                <h2><?php echo $posts[$i][1] ?></h2><br>
                <?php
            }
            ?>
        </div>

        <!--Filtering buttons based on user role. -->
        <?php
        $sql = "select cst126milestone.user_info.roleName from cst126milestone.user_info where userId = '$id'";
        $results = mysqli_query($conn, $sql) or die (mysqli_error());
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                if ($row['roleName'] == 'Admin') {
                    ?>
                    <div class="card">
                        <button onclick="window.location.href = 'createPost.html'" style="width:100%;">New</button>
                    </div>
                    <div class="card">
                        <button onclick="window.location.href = 'admin.php'" style="width:100%;">Admin</button>
                    </div>
                    <?php
                } else if ($row['roleName'] == 'Blogger') {
                    ?>
                    <div class="card">
                        <button onclick="window.location.href = 'createPost.html'" style="width:100%;">New</button>
                    </div>
                    <?php
                }
            }

        }
        ?>

        <div class="card" align="center">
            <img src="images/facebook.png" height="100" width="100">
            <img src="images/instagram.jpg" height="100" width="100">
        </div>
    </div>
</div>

<div class="footer">
    <h2>Footer</h2>
</div>


</body>

</html>