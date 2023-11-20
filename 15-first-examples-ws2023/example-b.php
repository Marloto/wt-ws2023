<!DOCTYPE html>
<html lang="en">
<head>
 <title>Document</title>
</head>
<body>
    <?php
    function doSomething($x, $y) {
        return $x * $y;
    }
    ?>
    <p><?= doSomething(6, 7) ?></p>
</body>
</html>