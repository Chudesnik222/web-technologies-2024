<?php
function getFiles() {
    $files = scandir(BASE_PATH . '/public/doc');
    return array_splice($files, 2);
}