<?php
if (!isset($pdo)) {
    require_once __DIR__ . '/db.php';
}

function hasChildren($id, $pdo) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM categories WHERE parent_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetchColumn() > 0;
}

function getMenuTree($pdo, $parentId = null) {
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE parent_id " .
                         (is_null($parentId) ? "IS NULL" : "= ?"));
    $stmt->execute(is_null($parentId) ? [] : [$parentId]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $html = '';
    foreach ($items as $item) {
        $hasChildren = hasChildren($item['id'], $pdo);
        if ($hasChildren) {
            $html .= '<div class="list-item list-item_open" data-parent>
                        <div class="list-item__inner">
                            <img class="list-item__arrow" src="img/chevron-down.png" alt="chevron-down" data-open>
                            <img class="list-item__folder" src="img/folder.png" alt="folder">
                            <span>' . htmlspecialchars($item['name']) . '</span>
                        </div>
                        <div class="list-item__items">';
            $html .= getMenuTree($pdo, $item['id']);
            $html .= '</div></div>';
        } else {
            $html .= '<div class="list-item">
                        <div class="list-item__inner">
                            <img class="list-item__folder" src="img/folder.png" alt="folder">
                            <span>' . htmlspecialchars($item['name']) . '</span>
                        </div>
                      </div>';
        }
    }

    return $html;
}