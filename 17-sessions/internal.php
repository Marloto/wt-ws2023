<?php
session_start();

if(!isset($_SESSION["ist_angemeldet"]) || !$_SESSION["ist_angemeldet"]) {
    header("Location: login.php");
    die();
}

// Nutzer wegleiten, wenn dieser unbekannt
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hallo, <?= $_SESSION["username"] ?></h1>
    <a href="logout.php">Abmelden...</a>
</body>
</html>