<head>
    <title></title>
<body>
<h2>Login was successful <br />
    <?php
    require_once('utility.php');
    insertUsers();
    $users = getAllUsers();
    include ('_displayUsers.php');
    ?>
</h2>
<a href="whoAmI.php">Who Am I</a>
</body>
</head>


