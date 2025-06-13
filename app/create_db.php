<?php
require_once __DIR__ . '/db.php';

$pdo->exec("
    CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        parent_id INT DEFAULT NULL,
        FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");

$stmt = $pdo->query("SELECT COUNT(*) FROM categories");
$count = $stmt->fetchColumn();

if ($count == 0) {
    echo "Таблица пуста. Добавляю тестовые данные...<br>";

    $pdo->exec("INSERT INTO categories (name, parent_id) VALUES ('Каталог товаров', NULL)");
    $catalogId = $pdo->lastInsertId();

    $pdo->exec("INSERT INTO categories (name, parent_id) VALUES ('Мойки', $catalogId)");
    $sinksId = $pdo->lastInsertId();
    $pdo->exec("INSERT INTO categories (name, parent_id) VALUES ('Фильтры', $catalogId)");
    $filtersId = $pdo->lastInsertId();

    $pdo->exec("INSERT INTO categories (name, parent_id) VALUES ('Ulgran', $sinksId)");
    $ulgranSinkId = $pdo->lastInsertId();
    $pdo->exec("INSERT INTO categories (name, parent_id) VALUES ('Vigro Mramor', $sinksId)");
    $pdo->exec("INSERT INTO categories (name, parent_id) VALUES ('Handmade', $sinksId)");
    $handmadeId = $pdo->lastInsertId();
    $pdo->exec("INSERT INTO categories (name, parent_id) VALUES ('Vigro Glass', $sinksId)");

    $pdo->exec("INSERT INTO categories (name, parent_id) VALUES ('Smth', $ulgranSinkId)");
    $pdo->exec("INSERT INTO categories (name, parent_id) VALUES ('Smth', $ulgranSinkId)");

    $pdo->exec("INSERT INTO categories (name, parent_id) VALUES ('Smth', $handmadeId)");
    $pdo->exec("INSERT INTO categories (name, parent_id) VALUES ('Smth', $handmadeId)");

    $pdo->exec("INSERT INTO categories (name, parent_id) VALUES ('Ulgran', $filtersId)");
    $ulgranFilterId = $pdo->lastInsertId();
    $pdo->exec("INSERT INTO categories (name, parent_id) VALUES ('Vigro Mramor', $filtersId)");

    $pdo->exec("INSERT INTO categories (name, parent_id) VALUES ('Smth', $ulgranFilterId)");
    $pdo->exec("INSERT INTO categories (name, parent_id) VALUES ('Smth', $ulgranFilterId)");

    echo "Данные успешно добавлены.<br>";

} else {
    echo "Таблица уже содержит данные, вставка не требуется.<br>";
}