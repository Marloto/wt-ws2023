<?php

$counter = new stdClass();
$counter->value = 0;
$counter->some = 0;
$counter->more = 0;
// Wenn Daten übertragen wurden, dann diese verwenden und verändern
if(isset($_POST['somevalue'])) {
    $counter = json_decode($_POST['somevalue']);
    $counter->value = $counter->value + 1;
}

$data = json_encode($counter);

// besser ggf. mit base64 zur Kodierierung der Daten die als JSON eingebettet werden
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
    <h1>Counter: <?= $counter->value; ?></h1>
    <form method="post">
        <!-- Input-Type Hidden erlaubt versteckte Datenfelder, als Ergänzung, die beim Absenden mit übertragen werden -->
        <input type="hidden" name="somevalue" value='<?= $data; ?>'>
        <button>+1</button>
    </form>
</body>
</html>