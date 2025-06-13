<?php 
    # Задание 6:
    function power($val, $pow) {
        if ($pow == 0) return 1;
        return $val * power($val, $pow - 1);
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/assets/styles/style.css">
    <title>Задание 6</title>
</head>
<body>
    <div class="result">
        <h2>Задание 6: Рекурсивное возведение в степень</h2>
        <p>2<sup>3</sup> = <?= power(2, 3) ?></p>
    </div>
</body>
</html>