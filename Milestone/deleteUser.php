<!--
All files authored by Matt Sievers
Date update 07/22/19
deleteUser.php
CST-126/Milestone
reference for blog template found @ https://www.w3schools.com/howto/howto_css_blog_layout.asp
-->
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
    <div class="row">
        <div class="rightColumn">
            <div class="card">
                <button onclick="window.location.href = 'searchUsers.php'" style="width:100%;">Search Users</button>
            </div>
            <div class="card">
                <button onclick="window.location.href = 'updateUser.php'" style="width:100%;">Update User</button>
            </div>
            <div class="card">
                <button onclick="window.location.href = 'userRegistrationPage.html'" style="width:100%;">Add User</button>
            </div>
            <div class="card">
                <button onclick="window.location.href = 'getContent.php'" style="width:100%;">Blog Home</button>
            </div>
            <div class="card">
                <button onclick="window.location.href = 'complianceResults.php'" style="width:100%;">Compliance Check
                </button>
            </div>
        </div>
        <div class="leftcolumn">
            <div class="card">
                <form action="" method="POST">

                    <div class="card">
                        <p>
                            <label for="userId">User ID</label>
                            <input type="text" id="userId" name="userId"
                                   maxlength="30" size="30"/>
                        </p>
                        <p>
                            <input type="submit" name="submit" value="Delete User">
                        </p>
                    </div>
                    <?php
                    require_once('database.php');
                    $conn = dbConnect();
                    $id = $_POST['userId'];
                    $sql = "update user_info set cst126milestone.user_Info.userDeleted = 'y' where cst126milestone.user_Info.userId = '$id'";
                    mysqli_query($conn, $sql)or die(mysqli_error());


                    ?>

                </form>
            </div>
        </div>
    </div>

</body>

</html>