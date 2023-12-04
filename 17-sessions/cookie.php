<?php

$counter = 0;

// $_COOKIE ist die magische Variable in der PHP
// Cookie Daten bereitstellt
if(isset($_COOKIE["somevalue"])) {
    $counter = $_COOKIE["somevalue"];
    $counter = $counter + 1;
}
// Speichert die Daten in einem Cookie im Client / Browser
setcookie("somevalue", $counter);
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
    <a href="cookie.php">+1</a>
</body>
</html>