<!DOCTYPE html>
<html lang="en">
<head>
 <title>Document</title>
</head>
<body>
    <?php
    function hello($name) {
    ?>
        <b><?php echo "Hello, $name"; ?></b>
    <?php
    }
    ?>
    <p><?php hello("world"); ?></p>
    <script>
        // Beispiel in JavaScript, Strings die Variablen
        // verwenden.
        var foo = 42;
        var abc = `abc... ${4 * foo}`;
    </script>
</body>
</html>