<?php
    # Задание 1
    $a = 14; 
    $b = 5; 

    if ($a >= 0 && $b >= 0) {
        $result = $a - $b;
    } elseif ($a < 0 && $b < 0) {
        $result = $a * $b; 
    } else {
        $result = $a + $b; 
    }
    ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/assets/styles/style.css">
    <title>Задание 1</title>
</head>
<body>
    <div class="result">
        <h2>Задание 1: Работа с переменными</h2>
        <p><strong>$a:</strong> <?= $a ?>, <strong>$b:</strong> <?= $b ?></p>
        <p><strong>Результат:</strong> <?= $result ?></p>
    </div>
</body>
</html>