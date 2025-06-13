<?php
require_once __DIR__ . '/../app/create_db.php';  
require_once __DIR__ . '/../app/menu.php';       
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Каталог товаров</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="list-items" id="list-items">
        <?= getMenuTree($pdo, null ); ?>
    </div>
    <script type="module" src="js/script.js"></script>
</body>
</html>