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

    </style>
</head>
<body>
<div class="header">
    <h2>Pending Unapproved Posts</h2>
</div>
<div class="row">
    <div class="leftcolumn">
        <form action="" method="POST">
            <?php
            require_once('database.php');
            require_once('utils.php');
            $conn = dbConnect();
            $posts = getUnapprovedPosts();
            for ($i = 0; $i < count($posts); $i++) {
                $id = $posts[$i][0];
                ?>

                <div class="card">
                <h2><?php echo $posts[$i][1] ?></h2>
                <h5><?php echo $posts[$i][2] ?></h5>
                <p><?php echo $posts[$i][3] ?> </p>
                <input type="submit" id='Approve' value="Approve" name="action" class="approve" />
                <input type="submit" id='Reject' value="Reject" name="action" class="reject" />
                <?php
                if ($_POST['action'] == 'Approve') {
                    $updateApproved = "UPDATE cst126milestone.posts SET post_accepted = 1, post_denied = null WHERE post_id = '$id'";
                    mysqli_query($conn, $updateApproved) or die(mysqli_error());
                    header("Refresh:0");
                } else if ($_POST['action'] == 'Reject') {
                    $updateDenied = "UPDATE cst126milestone.posts SET post_denied = 'Denied' WHERE post_id = '$id'";
                    mysqli_query($conn, $updateDenied) or die(mysqli_error());
                    header("Refresh:0");
                }
                ?>
                </div>
                <?php
            }
            ?>
        </form>

</body>

</html>