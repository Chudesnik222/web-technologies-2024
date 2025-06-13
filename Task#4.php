<?php 
    # Задание 4:
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
    function mathOperation($arg1, $arg2, $operation) {
        switch ($operation) {
            case "add":
                return add($arg1, $arg2);
            case "subtract":
                return subtract($arg1, $arg2);
            case "multiply":
                return multiply($arg1, $arg2);
            case "divide":
                return divide($arg1, $arg2);
            default:
                return "Неизвестная операция!";
        }
    }
?>
    
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/assets/styles/style.css">
    <title>Задание 4</title>
</head>
<body>
    <div class="result">
        <h2>Задание 4: Универсальная операция</h2>
        <p>10 + 5 = <?= mathOperation(10, 5, "add") ?></p>
        <p>10 - 5 = <?= mathOperation(10, 5, "subtract") ?></p>
        <p>10 * 5 = <?= mathOperation(10, 5, "multiply") ?></p>
        <p>10 / 5 = <?= mathOperation(10, 5, "divide") ?></p>
    </div>
</body>
</html>