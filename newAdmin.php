<?php
/** @var mysqli $db */
//connect with database
require_once("config.php");

//set base value for all variables, which is nothing
$name = $lastname = $email = $phone = "";

//if the post button gets pressed fill username password variables with the filled in data and hash the password
if (!empty($_POST)){
    $username = mysqli_escape_string($db, $_POST['username']);
    $password = $_POST['password'];
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    //check for any empty boxes
    $errors = [];

    if($username == ""){
        $errors['username'] = "Vul uw voornaam in";
    }

    if(strlen($password) < 8){
        $errors['password'] = "Een wachtwoord moet minimaal 8 tekens lang zijn";
    }
    if(strlen($password) > 255){
        $errors['password'] = "Een wachtwoord kan op onze website niet langer zijn dan 255 tekens";
    }
    if($password == ""){
        $errors['password'] = "Vul een wachtwoord in";
    }

    //if everything is filled in make a query to put the new admin user in the database
    if(empty($errors)){
        $sql = "INSERT INTO adminlogin (id, username, password)
            VALUES ('', '$username', '$hashed')";

        //if the query worked say it worked otherwise say there was a problem
        if(mysqli_query($db, $sql)) {
            echo "*Account succesvol toegevoegd";
        } else {
            echo "Er is een fout opgetreden waardoor het account niet is toegevoegd...";
        }
    }
    //close connection with the database
    mysqli_close($db);
}

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <title>Account aanmaken</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" href="images/syntegon_header_logo.png">
</head>

<body class="caribbeanGreenBackGround">
<div>
    <h3>Maak een account aan</h3>
    <form action="" method="post" class="divAccount">
        <div>
            <label for="username"><b>Gebruikersnaam</b></label>
            <span class="errors"><?php echo $errors['username'] ?? ''; ?></span>
            <br>
            <input class="inputAccount" id="username" type="text" placeholder="Voer hier uw voornaam in" name="username" value="<?php echo htmlentities($name); ?>">
        </div>
        <div>
            <label for="password"><b>Wachtwoord</b></label>
            <span class="errors"><?php echo $errors['password'] ?? ''; ?></span>
            <br>
            <input class="inputAccount" id="password" type="password" placeholder="Voer hier uw wachtwoord in" name="password">
        </div>
        <div>
            <button class="buttonAccount" type="submit">Account maken</button>
            <?php if (isset($errors['samePassword'])) { ?>
                <div><span class="errors"><?php echo $errors['samePassword']; ?></span></div>
            <?php } ?>
        </div>
    </form>
</div>
<footer class="bottom">
    <br>
    <a href="admin.php">Terug</a>
</footer>
</body>

</html>
