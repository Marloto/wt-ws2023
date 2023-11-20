<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="someform.php?foo=bar&info=..." method="post">
        <input name="info" type="text" value="42">
        <button>Submit</button>
    </form>
    <?php
    // Abrufen von Anfragendaten des HTTP-Requests
    // -> Get-Daten sind in $_GET
    // -> Post-Daten sind in $_POST
    // -> Get- und Post-Daten können parallel verwendet werden
    // -> Request-Daten sind in $_REQUEST
    echo "Ergebnis: " . $_REQUEST["info"] . "<br>";
    echo "Weitere Info: " . $_REQUEST["foo"] . "<br>";
    ?>
</body>
</html>