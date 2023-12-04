<?php

$counter = 0;
// Wenn Daten übertragen wurden, dann diese verwenden und verändern
if(isset($_POST['somevalue'])) {
    $counter = $_POST['somevalue'];
    $counter = $counter + 1;
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
    <!-- Informationen für Nutzer ausgeben -->
    <h1>Counter: <?= $counter; ?></h1>
    <form method="post">
        <!-- Input-Type Hidden erlaubt versteckte Datenfelder, als Ergänzung, die beim Absenden mit übertragen werden -->
        <input type="hidden" name="somevalue" value="<?= $counter; ?>">
        <button>+1</button>
    </form>
</body>
</html>