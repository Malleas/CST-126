<!--reference for blog template found @ https://www.w3schools.com/howto/howto_css_blog_layout.asp-->
<!--reference for tabbed header found @ https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_tab_header -->
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
    <h2>Blog Management</h2>
</div>
<div class="row">
    <div class="rightColumn">
        <div class="card">
            <button onclick="window.location.href = 'searchUsers.php'" style="width:100%;">Search Users</button>
        </div>
        <div class="card">
            <button onclick="window.location.href = 'updateUser.php'" style="width:100%;">Update User</button>
        </div>
        <div class="card">
            <button onclick="window.location.href = 'deleteUser.php'" style="width:100%;">Delete User</button>
        </div>
        <div class="card">
            <button onclick="window.location.href = 'addUser.php'" style="width:100%;">Add User</button>
        </div>
        <div class="card">
            <button onclick="window.location.href = 'getContent.php'" style="width:100%;">Blog Home</button>
        </div>
        <div class="card">
            <h2>Blog Metrics</h2>
            <?php
            $totalUsers = getUserCount();
            $deletedUsers = getDeletedUsersCount();
            $bannedUsers = getBannedUsers();
            $totalPosts = getPostsCount();
            ?>
            <table>
                <tr>
                    <td>Total Users</td>
                    <td><?php echo $totalUsers ?></td>
                </tr>
                <tr>
                    <td>Total Deleted Users</td>
                    <td><?php echo $deletedUsers ?></td>
                </tr>
                <tr>
                    <td>Total Banned Users</td>
                    <td><?php echo $bannedUsers ?></td>
                </tr>
                <tr>
                    <td>Total Posts</td>
                    <td><?php echo $totalPosts ?></td>
                </tr>
            </table>
        </div>
    </div>
    <?php

    $conn = dbConnect();
    $posts = getUnapprovedPosts();
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'Approve') {
            $id = $_POST['id'];
            $updateApproved = "UPDATE cst126milestone.posts SET post_accepted = 1, post_denied = null WHERE post_id = '$id'";
            mysqli_query($conn, $updateApproved) or die(mysqli_error());
            header("Refresh:0");
        } else if ($_POST['action'] == 'Reject') {
            $id = $_POST['id'];
            $updateDenied = "UPDATE cst126milestone.posts SET post_denied = 'Denied' WHERE post_id = '$id'";
            mysqli_query($conn, $updateDenied) or die(mysqli_error());
            header("Refresh:0");
        }
    }

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
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php print $id ?>"/>
                    <input type="submit" id='Approve' value="Approve" name="action" class="approve"/>
                    <input type="submit" id='Reject' value="Reject" name="action" class="reject"/>
                </form>


            </div>
            <?php
        }
        ?>
    </div>
</div>


</body>

</html>