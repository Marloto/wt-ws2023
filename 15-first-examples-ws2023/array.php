<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // Array in JavaScript: 
    // -> var someArr = [];
    // -> someArr[0] = 42;
    // -> var res = someArr[0];
    // -> var laengeDesArr = someArr.length;
    // -> keine max. größe
    // -> jedes Feld darf einen beliebigen Datentyp verwenden

    $someArr = array();
    $someArr[0] = 42;
    $someArr[1] = 21;
    $res = $someArr[0];
    echo $someArr[0];
    // Informationen in der Regel über Funktionen
    echo count($someArr);

    // PHP-Referenz als Grundlage: https://www.php.net/manual/en/

    for($i = 0; $i < count($someArr); $i++) {
        echo $someArr[$i];
    }
    ?>
</body>
</html>