<?php 
    # Задание 2:
    $a2 = rand(0, 15);
    $numbersFromA = "";

    switch ($a2) {
        case 0:  $numbersFromA .= "0 "; 
        case 1:  $numbersFromA .= "1 ";
        case 2:  $numbersFromA .= "2 ";
        case 3:  $numbersFromA .= "3 ";
        case 4:  $numbersFromA .= "4 ";
        case 5:  $numbersFromA .= "5 ";
        case 6:  $numbersFromA .= "6 ";
        case 7:  $numbersFromA .= "7 ";
        case 8:  $numbersFromA .= "8 ";
        case 9:  $numbersFromA .= "9 ";
        case 10: $numbersFromA .= "10 ";
        case 11: $numbersFromA .= "11 ";
        case 12: $numbersFromA .= "12 ";
        case 13: $numbersFromA .= "13 ";
        case 14: $numbersFromA .= "14 ";
        case 15: $numbersFromA .= "15";
            break;
        default:
            $numbersFromA = "Ошибка!";
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
        <h2>Задание 2: Вывод чисел от $a до 15</h2>
        <p><strong>Случайное $a:</strong> <?= $a2 ?></p>
        <p><strong>Числа:</strong> <?= $numbersFromA ?></p>
    </div>
</body>
</html>