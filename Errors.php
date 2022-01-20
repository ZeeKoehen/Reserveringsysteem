<?php

$errors = [];

if (strlen($name) > 150) {
    $errors['name'] = "Uw naam kan op deze website niet langer zijn dan 150 tekens";
}

if ($name == "") {
    $errors['name'] = "Vul uw naam in";
}

if (strlen($email) > 255) {
    $errors['email'] = "Uw e-mail kan op deze website niet langer zijn dan 100 tekens";
}

if ($email == '') {
    $errors['email'] = "Vul uw e-mail in";
}

if ($date == "") {
    $errors['date'] = "Kies een datum";
}

if ($time < '08:59:00') {
    $errors['time'] = "U kunt niet eerder reserveren dan 09:00";
}

if ($time > '17:00:00') {
    $errors['time'] = "U kunt niet later reserveren dan 17:00";
}

if ($time == "") {
    $errors['time'] = "Kies een tijd";
}

if ($type == "") {
    $errors['type'] = "Kies een style type";
}
