<?php 
    # Задание 5:
    $year1 = date("Y");
    $year2 = date("Y", strtotime("now"));
    $year3 = (new DateTime())->format("Y");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/assets/styles/style.css">
    <title>Задание 5</title>
</head>
<body>
    <div class="result">
        <h2>Задание 5: Текущий год</h2>
        <p>Способ 1: <?= $year1 ?></p>
        <p>Способ 2: <?= $year2 ?></p>
        <p>Способ 3: <?= $year3 ?></p>
    </div>
</body>
</html>