<?php
/** @var mysqli $db */

//connect with the database
require_once "config.php";
//connect with the check page which checks whether you are logged into an admin account or not
require_once "check.php";

//get the id from the url
$id = $_GET['id'];

//setup a query to show all the data for that specific person by using the id from the url
$query = "SELECT * FROM reservations WHERE id = '$id'";
$result = mysqli_query($db, $query) or die ('Error: ' . $query );

$data = mysqli_fetch_assoc($result);

//if the delete button gets pressed
if (isset($_POST['delete'])) {
    $deleteId = mysqli_escape_string($db, $_POST['saveId']);
    //delete all the data for that specific id from the database
    $deleteQuery = "DELETE FROM reservations WHERE id = '$deleteId'";
    $result = mysqli_query($db, $deleteQuery) or die ('Error: ' . mysqli_error($db));

    //if the delete worked close connection with the database and go to adminHome.php otherwise display that something went wrong
    if ($result) {
        mysqli_close($db);
        header("Location: adminHome.php");
    } else {
        echo "er is iets fout gegaan";
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete</title>
</head>
<body>
<h1>Delete</h1>
<h2>Weet u zeker dat u deze afspraak wilt verwijderen?</h2>
<p>Naam:    <?= $data['name'] ?></p>
<p>E-mail:  <?= $data['email'] ?></p>
<p>Stijl:   <?= $data['type'] ?></p>
<p>Datum:   <?= $data['date'] ?></p>
<p>Tijd:    <?= $data['time'] ?></p>

<form action="" method="post">
    <input type="hidden" name="saveId" value="<?= $data['id'] ?>">
<input type="submit" name="delete" id="delete" value="Ja (verwijderen)">
</form>

</body>
<footer>
    <br>
    <a href="adminHome.php">Terug</a>
</footer>
</html>
