<?php
// Wenn neuer Nutzer, dann neue ID, und wenn eine ID mitgeliefert
// werden alle bekannten Daten geladen
session_start();

if(isset($_SESSION["ist_angemeldet"]) && $_SESSION["ist_angemeldet"]) {
    header("Location: internal.php");
    die();
}

// "Tom" "12345678"
if(isset($_POST["action"]) && $_POST["action"] == "login") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if($username == "Tom" && $password == "12345678") {
        // Wie speichern, dass Sie angemeldet sind?
        // Gibt es zusätzliche Befehle um "Sessions" zu nutzen?
        $_SESSION["ist_angemeldet"] = true;
        $_SESSION["username"] = $username;
        header("Location: internal.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="login.php" method="post">
        <input type="text" name="username">
        <input type="password" name="password">
        <button name="action" value="login">Login</button>
    </form>
</body>
</html>