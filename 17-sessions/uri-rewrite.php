<?php
$counter = 0;
// Wenn Daten übertragen wurden, dann diese verwenden und verändern
if(isset($_GET['somevalue'])) {
    $counter = $_GET['somevalue'];
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
    <h1>Counter: <?= $counter; ?></h1>
    <a href="uri-rewrite.php?somevalue=<?= $counter ?>">+1</a>
</body>
</html>