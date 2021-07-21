<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <h1>Zeichenketten verbinden in php (String concatenation)</h1>
    <?php 
    $name = 'Peter';
    $str = 'Ich heisse ' . $name . '.';

    echo "\$str = 'Ich heisse ' . \$name . '.'" . '<br>';
    echo $str . '<br>';
    ?>
</body>

</html>