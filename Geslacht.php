<?php

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Geslacht</title>
</head>
<h1>Welk geslacht heeft u</h1>
<body>
<p>Selecteer één van de onderstaande opties.</p>

<form action="LaatsteInfo.php" method="post">
    <input type="radio" id="Gender1" name="gender" value="Woman">
    <label for="Woman">Dame</label> <br>
    <input type="radio" id="Gender2" name="gender" value="Man">
    <label for="Man">Heer</label> <br>
    <input type="radio" id="Gender3" name="gender" value="Kids">
    <label for="Kids">Kind</label>
    <div>
        <br>
        <input type="submit" name="submit" value="Volgende">
    </div>
</form>
</body>
<footer>
    <br>
    <a href="javascript:history.go(-1)">Ga terug</a>
</footer>
</html>