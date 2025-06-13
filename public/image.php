<?php
include __DIR__ . '/../config/config.php';

if (!isset($_GET['file'])) {
    http_response_code(400);
    exit('Файл не указан');
}

$file = $_GET['file'];

outputImageByAbsolutePath($file);