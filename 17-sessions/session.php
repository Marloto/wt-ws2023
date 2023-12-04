<?php

$counter = 0;

// Alte Sitzung forsetzen oder neue starten, danach existiert $_SESSION Variable
session_start();

// Eine neue magische Variable :)
// $_SESSION
if(isset($_SESSION["somevalue"])) {
    $counter = $_SESSION["somevalue"];
    $counter = $counter + 1;
}
// Manuelles Speichern über ein Funktion ist nicht notwendig!
// Alle Informationen müssen in der magischen Variable gespeichert werden
$_SESSION["somevalue"] = $counter;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Counter: <?= $counter; ?></h1>
    <a href="session.php">+1</a>
</body>
</html>