<?php
include __DIR__ . '/../config/config.php';

session_start();


$page = 'index';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}   



$params = [];

switch ($page) {
    case 'index':
        $params['title'] = 'Главная';
        
        break;

    case 'galery':
        $params['title'] = 'Галерея';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
            $result = uploadImage($_FILES['image']);
            $_SESSION['upload_result'] = $result;

            header('Location: /?page=galery');
            exit;
        }

        if (isset($_SESSION['upload_result'])) {
            $params['upload_result'] = $_SESSION['upload_result'];
            unset($_SESSION['upload_result']);
        }

        $dir = BASE_PATH . '/images/small/';
        $params['images'] = array_diff(scandir($dir), ['.', '..']);

        logRequest();
        
        break;

    case 'bux':
        /* if (!empty($_FILES)) {
            upload();
            header(/?page=bux);
        die();
        }*/

        $params['title'] = 'Бухи';
        $params['message'] = 'Файл загружен';
        $params['files'] = getFiles();
        _log($params, 'bux');
        break;

    case 'catalog':
        $params['title'] = 'Каталог';
        $params['catalog'] = getCatalog();
        break;

    case 'about':
        $params['title'] = 'about';
        $params['phone'] = 444333;
        
        break;

    case 'apicatalog':
        echo json_encode(getCatalog(), JSON_UNESCAPED_UNICODE);
        die();

    default:
        echo "404";
        die();
}

echo render($page, $params);