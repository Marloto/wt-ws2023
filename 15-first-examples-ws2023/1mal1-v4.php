<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Hello, World!"; ?></title>
</head>
<body>
    <div class="container">
        <?php
    // Funktionen in JavaScript?
    // -> function someName(param1, param2, ...) {
        //    return 42;
        // }
        function generateTable($maxX, $maxY) { ?>
            <table>
                <tbody>
<?php
        for($y = 1; $y <= $maxY; $y ++) {
            echo "<tr>\n";
            for($x = 1; $x <= $maxX; $x ++) {
                $value = $x * $y;
                $res = "<td>" . $value . "</td>\n";
                echo $res;
            }
            echo "</tr>\n";
        } ?>
    </tbody>
    </table>
<?php
    }
    generateTable(3, 3);
    generateTable(3, 3);
?>
    </div>
</body>
</html>