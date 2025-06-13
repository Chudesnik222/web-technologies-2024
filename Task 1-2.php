<?php

  # Задание 1:
  $pageTitle = "Добро пожаловать на мой сайт";
  $mainHeading = "Привет, мир!";
  $currentYear = date("Y");

  # Задание 2:
  function getTimeWithWords() {
      $hours = (int)date('G');     
      $minutes = (int)date('i');     

      # Определяем склонение для "час"
      if ($hours % 10 == 1 && $hours % 100 != 11) {
          $hoursWord = "час";
      } elseif (in_array($hours % 10, [2, 3, 4]) && !in_array($hours % 100, [12, 13, 14])) {
          $hoursWord = "часа";
      } else {
          $hoursWord = "часов";
      }

      # Определяем склонение для "минута"
      if ($minutes % 10 == 1 && $minutes % 100 != 11) {
          $minutesWord = "минута";
      } elseif (in_array($minutes % 10, [2, 3, 4]) && !in_array($minutes % 100, [12, 13, 14])) {
          $minutesWord = "минуты";
      } else {
          $minutesWord = "минут";
      }

      return "$hours $hoursWord $minutes $minutesWord";
  }

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title><?= $pageTitle; ?></title>
  <link rel="stylesheet" href="src/assets/styles/style.css">
</head>
<body>
  <header>
    <div class="task_1">
      <h2>Задание 1:</h2>
      <h1><?= $mainHeading; ?></h1>
      <p>Это страница, сгенерированная на PHP.</p>
    </div>
    <div class="task_2">
      <h2>Задание 2:</h2>
      <?= getTimeWithWords(); ?>
    </div>
    
  </header>

  <footer>
    &copy; <?= $currentYear; ?> Мой сайт. Все права защищены.
  </footer>
</body>
</html>