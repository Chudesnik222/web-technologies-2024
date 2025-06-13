<?php 
    # Задание 3:
    function add($a, $b) {
    return $a + $b;
    }

    function subtract($a, $b) {
        return $a - $b;
    }

    function multiply($a, $b) {
        return $a * $b;
    }

    function divide($a, $b) {
        return $b != 0 ? $a / $b : "Ошибка: деление на 0!";
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/assets/styles/style.css">
    <title>Задание 2</title>
</head>
<body>
    <div class="result">
        <h2>Задание 3: Арифметические функции</h2>
        <ul>
            <li>Сложение (5 + 3): <?= add(5, 3) ?></li>
            <li>Вычитание (5 - 3): <?= subtract(5, 3) ?></li>
            <li>Умножение (5 * 3): <?= multiply(5, 3) ?></li>
            <li>Деление (6 / 3): <?= divide(6, 3) ?></li>
        </ul>
    </div>
</body>
</html>