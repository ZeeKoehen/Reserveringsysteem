<?php
/** @var mysqli $db */

//connect with database
require_once "config.php";
//connect with the check page which checks whether you are logged into an admin account or not
require_once "check.php";

//get id from the url
$id = $_GET['id'];

//setup a query to display all the information for that specific person by using the id from the url
$query = "SELECT * FROM reservations WHERE id = '$id'";
$result = mysqli_query($db, $query);

$appointment = mysqli_fetch_assoc($result);

//if the submit button gets pressed all the variables will become whatever was filled in in the form
if (isset($_POST['submit'])) {
    $name   = mysqli_escape_string($db, $_POST['name']);
    $email  = mysqli_escape_string($db, $_POST['email']);
    $type   = mysqli_escape_string($db, $_POST['type']);
    $date   = mysqli_escape_string($db, $_POST['date']);
    $time   = mysqli_escape_string($db, $_POST['time']);

    //connect with the error page and check for errors
    require_once "Errors.php";

    //if there are no errors
    if (empty($errors)) {
        //setup a query to update all the data from the site to the database for that specific id
        $query = "UPDATE reservations SET name='$name', email='$email', type='$type', date='$date', time='$time' WHERE id='$id'";
        //and perfrom the query
        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        //if the query worked go back to adminHome.php and exit the php file otherwise display that there was an error
        if ($result) {
            header('Location: adminHome.php');
            exit;
        } else {
            $errors['db'] = 'Er is iets fout gegaan bij het updaten van de afspraak: ' . mysqli_error($db);
        }
        //close connectino with the database
        mysqli_close($db);
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
    <title>Edit</title>
</head>
<body>
<h1>Edit</h1>
<form action="" method="post">
    <div class="data-field">
        <label for="name">Naam: </label>
        <input id="name" type="text" name="name" value="<?= $appointment['name'] ?>"/>
    </div>
    <div class="data-field">
        <label for="email">E-mail: </label>
        <input id="email" type="text" name="email" value="<?= $appointment['email'] ?>"/>
    </div>
    <div class="data-field">
        <label for="type">Stijl: </label>
        <input id="type" type="text" name="type" value="<?= $appointment['type'] ?>"/>
    </div>
    <div class="data-field">
        <label for="date">Datum: </label>
        <input id="date" type="date" name="date" value="<?= $appointment['date'] ?>"/>
    </div>
    <div class="data-field">
        <label for="time">Tijd: </label>
        <input id="time" type="time" name="time" value="<?= $appointment['time'] ?>"/>
    </div>
    <div class="data-submit">
        <input type="submit" name="submit" value="Opslaan"/>
    </div>
</form>
</body>
<footer>
    <br>
    <a href="adminHome.php">Terug</a>
</footer>
</html>