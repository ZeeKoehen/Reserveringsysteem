<?php
/** @var mysqli $db */

//connect with database
require_once "config.php";
//connect with the check page which checks whether you are logged into an admin account or not
require_once "check.php";

//get the id from the url
$id = $_GET['id'];

//setup a query to display all the information of that specific person by using the id in the url
$query = "SELECT * FROM reservations WHERE id = '$id'";
$result = mysqli_query($db, $query) or die ('Error: ' . $query );

$data = mysqli_fetch_assoc($result);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Afspraak Details</title>
</head>
<body>
<h1>Details</h1>
<p>Naam:    <?= $data['name'] ?></p>
<p>E-mail:  <?= $data['email'] ?></p>
<p>Stijl:   <?= $data['type'] ?></p>
<p>Datum:   <?= $data['date'] ?></p>
<p>Tijd:    <?= $data['time'] ?></p>
</body>
<footer>
    <br>
    <a href="adminHome.php">Terug</a>
</footer>
</html>