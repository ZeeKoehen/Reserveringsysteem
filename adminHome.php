<?php
/** @var mysqli $db */

//connect with database
require_once "config.php";
//connect with the check page which checks whether you are logged into an admin account or not
require_once "check.php";

//set up a query to select all the reservations
$query = "SELECT * FROM reservations";
$result = mysqli_query($db, $query) or die ('Error: ' . $query );

//set all of the reservations into an array and make a table out of them
$appointments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $appointments[] = $row;
}

mysqli_close($db);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Home</title>
</head>
<body>
<h1>Admin Home</h1>
<h2>Alle afspraken</h2>

<table>
    <thead>
    <tr>
        <th>Naam</th>
        <th>E-mail</th>
        <th>Stijl</th>
        <th>Datum</th>
        <th>Tijd</th>
        <th colspan="2"></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="9">&copy; My Collection</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($appointments as $appointment) { ?>
        <tr>
            <td><?= $appointment['name'] ?></td>
            <td><?= $appointment['email'] ?></td>
            <td><?= $appointment['type'] ?></td>
            <td><?= $appointment['date'] ?></td>
            <td><?= $appointment['time'] ?></td>
            <td><a href="details.php?id=<?= $appointment['id'] ?>">Details</a></td>
            <td><a href="edit.php?id=<?= $appointment['id'] ?>">Edit</a></td>
            <td><a href="delete.php?id=<?= $appointment['id'] ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
<footer>
    <br>
    <a href="logout.php">Uitloggen</a>
</footer>
</html>