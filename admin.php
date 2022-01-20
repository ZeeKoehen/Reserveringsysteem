<?php
session_start();

if (isset($_SESSION['loggedInAdmin'])) {
    $login = true;
} else {
    $login = false;
}

/** @var mysqli $db */
//connect with database
require_once("config.php");

//if the submit button gets pressed this part of the code will save whatever was filled in the form
if (isset($_POST['adminLogin'])) {
    $username   = mysqli_escape_string($db, $_POST['username']);
    $password   = $_POST['password'];

    //here it will check if there are any errors
    $errors = [];
    if ($username == '') {
        $errors['username'] = "Vul uw gebruikersnaam in";
    }

    if (strlen($username) > 20) {
        $errors['username'] = "Gebruikersnaam kan niet langer zijn dan 20 tekens";
    }

    if ($password == '') {
        $errors['password'] = "Vul uw wachtwoord in";
    }

    if (strlen($password) > 20) {
        $errors['password'] = "Wachtwoord kan niet langer zijn dan 20 tekens";
    }

    //if there are no errors the query will get performed
    if(empty($errors)) {
        $query = "SELECT * FROM adminlogin WHERE username='$username'";
        $result = mysqli_query($db, $query);
        //if the query worked set the user data to be the same as the result data
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            //if the user data is the same as the admin username and password it will login otherwise it will say there's something wrong
            if (password_verify($password, $user['password'])) {
                $login = true;

                $_SESSION['loggedInAdmin'] = [
                        'username' => $user['username'],
                        'id' => $user['id']
                ];
                header('Location: adminHome.php');
            } else {
                $errors['loginFailed'] = 'De combinatie van email en wachtwoord is niet bekend';
            }
        } else {
            $errors['loginFailed'] = 'De combinatie van email en wachtwoord is bekend';
        }
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
    <title>admin</title>
</head>
<body>
<h1>Vul gegevens in</h1>
<form action="" method="post">
    <label for="userID">Gebruikersnaam</label>
    <input type="text" name="username" id="username">
    <span><?php echo isset($errors['username']) ? $errors['username'] : '' ?></span> <br>
    <label for="password">Wachtwoord</label>
    <input type="password" name="password" id="password">
    <span><?php echo isset($errors['password']) ? $errors['password'] : '' ?></span>
    <div>
        <p><?php echo isset($errors['loginFailed']) ? $errors['loginFailed'] : '' ?></p>
        <input type="submit" name="adminLogin" value="Login">
    </div>
</form>
</body>
<footer>
    <br>
    <a href="newAdmin.php">Nieuw account aanmaken</a>
</footer>
</html>
