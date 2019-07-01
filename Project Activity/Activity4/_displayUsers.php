<html>
<head>
<body>
<tr>
    <th>ID</th>
    <th>First Name</th>
    <th>Last Name</th><br />
    <?php
    for ($x = 0; $x < count($users); $x++) {
        echo "<tr>";
        echo "<td>" . $users[$x][0] . "</td>" . "<td>" . $users[$x][1] . "</td>" . "</td>" . "<td>" . $users[$x][2] . "</td>"."<br />";
        echo "</tr>";
    } ?>
</tr>
</body>
</head>
</html>