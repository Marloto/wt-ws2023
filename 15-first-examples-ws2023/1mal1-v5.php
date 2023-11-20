<?php
error_reporting (E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set ('display_errors', 1);

$maxX = 3;
$maxY = 3;

if(isset($_GET['maxX'])) {
    $maxX = $_GET['maxX'];
}
if(isset($_GET['maxY'])) {
    $maxY = $_GET['maxY'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Hello, World!"; ?></title>
</head>
<body>
    <div class="container">
        <form>
            <input name="maxX" type="number" value="<?= $maxX; ?>"><input name="maxY" type="number" value="<?= $maxY; ?>"><button>Show</button>
        </form>
        <?php
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
        } 
        ?>
    </tbody>
    </table>
<?php
    }
    // Frage: wie könnte das generate basierend auf
    //   einem Formular erzeugt werden?
    //   -> form
    //   -> zwei felder
    //   -> name vergeben
    //   -> maxX und maxY in Action ergänzen?

    generateTable($maxX, $maxY);
?>
    </div>
</body>
</html>