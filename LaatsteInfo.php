<?php
/** @var mysqli $db */
//connect with database
require_once("config.php");

//set base values for all variables
$woman = 'Woman';
$man = 'Man';
$kids = 'Kids';
$name = '';
$email = '';
$date = '';
$time = '';

//if the submit button gets hit the gender becomes whatever gender was chosen
if (isset($_POST['submit'])) {
    $gender = $_POST['gender'];
}
//if the submit (other) button gets hit the gender becomes whatever the gender was
if (isset($_POST['other'])) {
    $gender = $_POST['gender'];
}

//if the submit (other) button gets hit all the variables get filled with whatever was chosen in the form
if (isset($_POST['other'])) {
    $name   = mysqli_escape_string($db, $_POST['name']);
    $email  = mysqli_escape_string($db, $_POST['email']);
    $type   = mysqli_escape_string($db, $_POST['type']);
    $date   = mysqli_escape_string($db, $_POST['date']);
    $time   = mysqli_escape_string($db, $_POST['time']);

    //connect with the errors page
    require_once("Errors.php");

    //if there are no errors continue otherwise display where the empty input was missing
    if (empty($errors)) {
        //after everything is filled this part of the code will insert the data in to the database
        $sql = "INSERT INTO reservations (id, name, email, type, date, time)
                VALUES ('', '$name', '$email', '$type', '$date', '$time')";

        //make the result variable the query function
        $result = mysqli_query($db, $sql);

        //if result worked go to conformatie.php
        if ($result) {
            header('Location: Conformatie.php');
            exit;
        }
    }
    //close connection with database
    mysqli_close($db);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informatie</title>
</head>
<body>
<h1>Behandeling</h1>
<p>Kies hier hoe u geknipt wilt worden, wanneer en hoe laat u geknipt wilt worden en vul ook uw naam en e-mail in.</p>
<form action="" method="post">
    <?php if ($gender == $woman) { ?>
    <input type="radio" id="wHair1" name="type" value="Knippen & Drogen dame € 38,35">
    <label for="wHair1">Knippen & Drogen dame € 38,35</label> <br>
    <input type="radio" id="wHair2" name="type" value="Knippen & Drogen lang haar € 38,35">
    <label for="wHair2">Knippen & Drogen lang haar € 38,35</label> <br>
    <input type="radio" id="wHair3" name="type" value="Studenten tarief dame € 32,90">
    <label for="wHair3">Studenten tarief dame € 32,90</label> <br>
    <input type="radio" id="wHair4" name="type" value="Wassen, Knippen & Föhnen/watergolf € 60,30">
    <label for="wHair4">Wassen, Knippen & Föhnen/watergolf € 60,30</label> <br>
    <input type="radio" id="wHair5" name="type" value="Beach Wave- knippen € 97,50">
    <label for="wHair5">Beach Wave- knippen € 97,50</label> <br>

    <?php } elseif ($gender == $man) { ?>
    <input type="radio" id="mHair1" name="type" value="Knippen heer € 38,35">
    <label for="mHair1">Knippen heer € 38,35</label> <br>
    <input type="radio" id="mHair2" name="type" value="Knippen heer & Baard modelleren € 46,35">
    <label for="mHair2">Knippen heer & Baard modelleren € 46,35</label> <br>
    <input type="radio" id="mHair3" name="type" value="Service knippen € 21,65">
    <label for="mHair3">Service knippen € 21,65</label> <br>
    <input type="radio" id="mHair4" name="type" value="Studenten tarief heer € 32,90">
    <label for="mHair4">Studenten tarief heer € 32,90</label> <br>
    <input type="radio" id="mHair5" name="type" value="Tondeuse coupe € 23,45">
    <label for="mHair5">Tondeuse coupe € 23,45</label> <br>

    <?php } elseif ($gender == $kids) { ?>
    <input type="radio" id="kHair1" name="type" value="Knippen Kind 1 t/m 11 € 22,60">
    <label for="kHair1">Knippen Kind 1 t/m 11 € 22,60</label> <br>
    <input type="radio" id="kHair2" name="type" value="Knippen Kind 12 t/m 14 € 30,40">
    <label for="kHair2">Knippen Kind 12 t/m 14 € 30,40</label> <br>
    <?php } ?>

    <br>
    <label for="date">Datum</label>
    <input type="date" name="date" id="date" value="<?= $date ?>">
    <span><?php echo isset($errors['date']) ? $errors['date'] : '' ?></span> <br>
    <label for="time">Tijd</label>
    <input type="time" name="time" id="time" value="<?= $time ?>">
    <span><?php echo isset($errors['time']) ? $errors['time'] : '' ?></span> <br>
    <label for="name">Naam</label>
    <input type="text" id="name" name="name" value="<?= $name ?>">
    <span><?php echo isset($errors['name']) ? $errors['name'] : '' ?></span> <br>
    <label for="email">E-mail</label>
    <input type="text" id="email" name="email" value="<?= $email ?>">
    <span><span><?php echo isset($errors['email']) ? $errors['email'] : '' ?></span></span>
    <div>
        <br>
        <input type="hidden" name="gender" value="<?= $gender ?>">
        <input type="submit" name="other" value="Afspraak vaststellen">
    </div>
</form>
</body>
<footer>
    <br>
    <a href="javascript:history.go(-1)">Ga terug</a>
</footer>
</html>
