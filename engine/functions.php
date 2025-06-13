<?php

function render($page, $params = []) {
    return renderTemplate(LAYOUTS_DIR . 'main', [
        'title' => $params['title'],
        'menu' => renderTemplate('menu', $params),
        'content' => renderTemplate($page, $params)
    ]);
}


//$params = ['menu' => 'код меню', 'catalog' => ['чай'], 'content' => 'Код подшаблона']
function renderTemplate($page, $params = []) {

    /*    foreach ($params as $key => $value) {
            $$key = $value;
        }*/
    extract($params);

    ob_start();
    include TEMPLATES_DIR . $page . ".php";
    return ob_get_clean();
}

function createThumbnail($sourcePath, $destPath, $width, $height) {
    $info = getimagesize($sourcePath);
    if (!$info) {
        return 'Ошибка: файл не является изображением.';
    }

    $mime = $info['mime'];

    switch ($mime) {
        case 'image/jpeg': $srcImage = imagecreatefromjpeg($sourcePath); break;
        case 'image/png':  $srcImage = imagecreatefrompng($sourcePath); break;
        case 'image/gif':  $srcImage = imagecreatefromgif($sourcePath); break;
        case 'image/webp': $srcImage = imagecreatefromwebp($sourcePath); break;
        default: return 'Ошибка: неподдерживаемый тип изображения.';
    }

    $srcWidth = $info[0];
    $srcHeight = $info[1];

    $thumb = imagecreatetruecolor($width, $height);
    imagecopyresampled($thumb, $srcImage, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight);

    switch ($mime) {
        case 'image/jpeg': imagejpeg($thumb, $destPath); break;
        case 'image/png':  imagepng($thumb, $destPath); break;
        case 'image/gif':  imagegif($thumb, $destPath); break;
        case 'image/webp': imagewebp($thumb, $destPath); break;
    }

    imagedestroy($thumb);
    imagedestroy($srcImage);
    return true;
}
    

function uploadImage($file) {

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowedTypes)) {
        return 'Недопустимый тип изображения.';
    }

    $maxSize = 10 * 1024 * 1024;

    if ($file['size'] > $maxSize) {
        return 'Файл слишком большой. Максимальный размер — 10 МБ.';
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        switch ($file['error']) {
            case UPLOAD_ERR_INI_SIZE:
                return 'Ошибка: размер файла превышает максимально разрешённый сервером.';
            case UPLOAD_ERR_FORM_SIZE:
                return 'Ошибка: размер файла превышает максимально разрешённый в форме.';
            case UPLOAD_ERR_PARTIAL:
                return 'Ошибка: файл был загружен не полностью.';
            case UPLOAD_ERR_NO_FILE:
                return 'Ошибка: файл не был загружен.';
            default:
                return 'Ошибка загрузки файла.';
        }
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowedTypes)) {
        return 'Недопустимый тип изображения.';
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = uniqid('img_', true) . '.' . $ext;

    $bigDir = BASE_PATH . '/images/big/';
    $smallDir = BASE_PATH . '/images/small/';

    if (!is_dir($bigDir)) mkdir($bigDir, 0777, true);
    if (!is_dir($smallDir)) mkdir($smallDir, 0777, true);

    $bigPath = $bigDir . $newName;
    if (!move_uploaded_file($file['tmp_name'], $bigPath)) {
        return 'Не удалось сохранить оригинал изображения.';
    }

    $smallPath = $smallDir . $newName;
    $thumbResult = createThumbnail($bigPath, $smallPath, 300, 300);
    if ($thumbResult !== true) {
        unlink($bigPath);
        return $thumbResult;
    }

    return 'Изображение успешно загружено!';
}

function outputImageByAbsolutePath(string $absolutePath): void {
    if (!file_exists($absolutePath) || !is_file($absolutePath)) {
        http_response_code(404);
        exit('Файл не найден');
    }

    $realPath = realpath($absolutePath);
    $allowedBase = realpath(BASE_PATH . '/images');

    if ($realPath === false || strpos($realPath, $allowedBase) !== 0) {
        http_response_code(403);
        exit('Доступ запрещён');
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $realPath);
    finfo_close($finfo);

    header('Content-Type: ' . $mime);
    header('Content-Length: ' . filesize($realPath));
    readfile($realPath);
    exit;
}