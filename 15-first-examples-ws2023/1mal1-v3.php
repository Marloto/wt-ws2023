<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Hello, World!"; ?></title>
</head>
<body>
    <div class="container">
        <table>
            <tbody>
<?php for($y = 1; $y <= 3; $y ++) { ?>
<tr>
<?php   for($x = 1; $x <= 3; $x ++) { ?>
<td><?= $x * $y; ?></td>
<?php } ?>
</tr>
<?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>