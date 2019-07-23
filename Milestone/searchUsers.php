<!--
All files authored by Matt Sievers
Date update 07/22/19
searchUser.php
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
                <button onclick="window.location.href = 'updateUser.php'" style="width:100%;">Update User</button>
            </div>
            <div class="card">
                <button onclick="window.location.href = 'deleteUser.php'" style="width:100%;">Delete User</button>
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
                <?php
                require_once('database.php');
                require_once('utils.php');
                $conn = dbConnect();
                $users = getAllUsers();
                for ($i = 0; $i < count($users); $i++) {
                    ?>

                    <table id="userTable">
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Role</th>
                        </tr>
                        <tr>
                            <td><?php echo $users[$i][0] ?></td>
                            <td><?php echo $users[$i][1] ?></td>
                            <td><?php echo $users[$i][2] ?></td>
                            <td><?php echo $users[$i][3] ?></td>
                            <td><?php echo $users[$i][4] ?></td>
                        </tr>
                    </table>

                    <?php
                }
                ?>
            </form>
        </div>
    </div>
</div>

</body>

</html>