<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <p>Aufgabe: Zähle alle Zahlen von 1 bis 100 zusammen und zeige das Resultat im Browser.</p>
    <p>Task: Add all numbers from 1 to 100 and show the result in the browser.</p>
    

    <?php
    // WHILE -------------------------------------------------------
    echo '<h1>php while-Schleife</h1>' . PHP_EOL;

    $num = 1;
    $sum = 0;

    while ($num <= 100) {
        $sum += $num; // is the same as $sum = $sum + $num;
        $num++; // is the same as $num = $num + 1;
    }

    $sumCalculated = (100 + 1) * 100 / 2; // result is 5050

    echo "The sum of the number 1 to 100 is " . $sum . '<br>';
    echo '(' . $sumCalculated . ')<br>';

    // DO WHILE ---------------------------------------------------
    echo '<h1>php do-while-Schleife</h1>' . PHP_EOL;

    $num = 1;
    $sum = 0;

    do {
        $sum += $num; // is the same as $sum = $sum + $num;
        $num++; // is the same as $num = $num + 1;
    } while ($num <= 100);

    echo $sum . '<br>';

    // FOR ---------------------------------------------------
    echo '<h1>php for-loops</h1>' . PHP_EOL;

    // $num = 1;
    $sum = 0;

    for ($num = 1; $num <= 100; $num++) {
        $sum += $num; // is the same as $sum = $sum + $num;
        // not necessary in the for-loop: $num++; 
    }

    echo $sum . '<br>';

    ?>
</body>

</html>