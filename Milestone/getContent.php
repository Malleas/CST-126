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

        label {
            width: 200px;
            float: left;
            text-align: left;
            font-weight: bold;
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
            } else {
                echo "No post id set.";
            }
        } elseif ($_POST['action'] == 'Delete') {
            if (isset($_POST['id'])) {
                $deleteId = $_POST['id'];
                $sql = "delete from cst126milestone.posts where cst126milestone.posts.post_id = '$deleteId'";
                mysqli_query($conn, $sql) or die(mysqli_error());
                header("Refresh:0");
                exit;

            } else if ($_POST['action'] == 'Comment') {
                if (isset($_POST['id'])) {
                    header("Location:comment.php");
                    exit;
                }
            } else if ($_POST['action'] == 'View') {
                if (isset($_POST['id'])) {
                    header("Location:viewComments.php");
                    exit;
                }

            } else {

                echo "No post ID Set";
            }
        }

    } else {
        //additional error handling if needed.

    }
    if (isset($_POST['rate1'])) {
        if (isset($_POST['id'])) {
            $ratePostId = $_POST['id'];
            $rate = 1;
            updateRate($ratePostId, $rate);
        }
    }
    if (isset($_POST['rate2'])) {
        if (isset($_POST['id'])) {
            $ratePostId = $_POST['id'];
            $rate = 2;
            updateRate($ratePostId, $rate);
        }
    }
    if (isset($_POST['rate3'])) {
        if (isset($_POST['id'])) {
            $ratePostId = $_POST['id'];
            $rate = 3;
            updateRate($ratePostId, $rate);
        }
    }
    if (isset($_POST['rate4'])) {
        if (isset($_POST['id'])) {
            $ratePostId = $_POST['id'];
            $rate = 4;
            updateRate($ratePostId, $rate);
        }
    }
    if (isset($_POST['rate5'])) {
        if (isset($_POST['id'])) {
            $ratePostId = $_POST['id'];
            $rate = 5;
            updateRate($ratePostId, $rate);
        }
    }

    ?>


    <div class="leftcolumn">
        <?php
        $posts = getPosts();
        print $data['avg'];
        for ($i = 0; $i < count($posts); $i++) {
            $postId = $posts[$i][0];
            $commentCount = getCommentCount($postId);
            $rate = getRate($postId);
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
                            <h5>Post Rating:<?php echo " " . $rate ?></h5>
                            <form method="post" action="updatePost.php" style="display: inline-block">
                                <input type="hidden" name="id" value="<?php print $postId ?>">
                                <input type="submit" id='Update' value="Update" name="action" class="Update"/>
                            </form>
                            <form method="post" action="" style="display: inline-block">
                                <input type="hidden" name="id" value="<?php print $postId ?>">
                                <input type="submit" id='Delete' value="Delete" name="action" class="Delete"/>
                            </form>
                            <form method="post" action="comment.php" style="display: inline-block">
                                <input type="hidden" name="id" value="<?php print $postId ?>">
                                <input type="submit" id='Comment' value="Comment" name="action" class="Comment"/>
                            </form>
                            <form method="post" action="viewComments.php" style="display: inline-block">
                                <input type="hidden" name="id" value="<?php print $postId ?>">
                                <input type="submit" align="left" id='View'
                                       value="View Comments<?php echo "($commentCount)" ?>" name="action" class="View"/>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?php print $postId ?>">
                                <input type="radio" onchange="this.form.submit();" name="rate1" value="rate1"
                                       id="rate1"> 1
                                <input type="radio" onchange="this.form.submit();" name="rate2" value="rate2"
                                       id="rate2"> 2
                                <input type="radio" onchange="this.form.submit();" name="rate3" value="rate3"
                                       id="rate3"> 3
                                <input type="radio" onchange="this.form.submit();" name="rate4" value="rate4"
                                       id="rate4"> 4
                                <input type="radio" onchange="this.form.submit();" name="rate5" value="rate5"
                                       id="rate5"> 5
                            </form>

                            <?php
                        } else if ($row['roleName'] == 'Blogger') {
                            ?>
                            <h5>Post Rating:<?php echo " " . $rate ?></h5>
                            <form method="post" action="updatePost.php" style="display: inline-block">
                                <input type="hidden" name="id" value="<?php print $postId ?>">
                                <input type="submit" id='Update' value="Update" name="action" class="Update"/>
                            </form>
                            <form method="post" action="comment.php" style="display: inline-block">
                                <input type="hidden" name="id" value="<?php print $postId ?>">
                                <input type="submit" id='Comment' value="Comment" name="action" class="Comment"/>
                            </form>
                            <form method="post" action="viewComments.php" style="display: inline-block">
                                <input type="hidden" name="id" value="<?php print $postId ?>">
                                <input type="submit" align="left" id='View'
                                       value="View Comments<?php echo "($commentCount)" ?>" name="action" class="View"/>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?php print $postId ?>">
                                <input type="radio" onchange="this.form.submit();" name="rate1" value="rate1"
                                       id="rate1"> 1
                                <input type="radio" onchange="this.form.submit();" name="rate2" value="rate2"
                                       id="rate2"> 2
                                <input type="radio" onchange="this.form.submit();" name="rate3" value="rate3"
                                       id="rate3"> 3
                                <input type="radio" onchange="this.form.submit();" name="rate4" value="rate4"
                                       id="rate4"> 4
                                <input type="radio" onchange="this.form.submit();" name="rate5" value="rate5"
                                       id="rate5"> 5
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
            <form action="searchResults.php" method="post" style="display: inline-block">
                <p>
                    <label for="searchBox"></label>
                    <input type="text" id="searchBox" name="searchBox" style="width:75%;"/>
                    <input type="submit" name="submit" value="Search">
                </p>
            </form>
        </div>
        <div class="card">
            <h2>About Me</h2>
            <div class="fakeimg" style="height:200px;"></div>
            <p>Some text about me and stuff</p>
        </div>
        <h3>Popular Posts</h3>
        <div class="card">
            <?php
            $popPost = getHighestRatedPost();
            for ($i = 0; $i < count($popPost); $i++) {
                ?>
                <h2><?php echo $popPost[$i][1]?><h5><?php echo "Post Rating ".$popPost[$i][2] ?></h5></h2>

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
                    $_SESSION['id'] = $id;
                    $_SESSION['userName'] = $userName;
                    ?>
                    <div class="card">
                        <button onclick="window.location.href = 'createPost.php'" style="width:100%;">New</button>
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