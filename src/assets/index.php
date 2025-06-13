<?php

// Блок переменных
$title = 'Моя главная страница';
$content = 'Добро пожаловать!';
$current_year = date('Y');

// Функция для вычисления и форматирования текущего времени
function getCurrentTimeWith() {
    $hour = (int)date('G');
    $minute = (int)date('i');

    // Определяем склонение для часов
    $hour_text = 'часов';
    if ($hour % 10 == 1 && $hour != 11) {
        $hour_text = 'час';
    } elseif (($hour % 10 >= 2 && $hour % 10 <= 4) && ($hour < 10 || $hour > 20)) {
        $hour_text = 'часа';
    }

    // Определяем склонение для минут
    $minute_text = 'минут';
    if ($minute % 10 == 1 && $minute != 11) {
        $minute_text = 'минута';
    } elseif (($minute % 10 >= 2 && $minute % 10 <= 4) && ($minute < 10 || $minute > 20)) {
        $minute_text = 'минуты';
    }

    return sprintf('%d %s %d %s', $hour, $hour_text, $minute, $minute_text);
}

$current_time = getCurrentTimeWith();

// Подключаем HTML-шаблон
include 'template.php';

?>
