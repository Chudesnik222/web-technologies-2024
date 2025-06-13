<?php

use FFI\CData;

define('TEMPLATES_DIR', 'templates/');
define('LAYOUTS_DIR', 'layouts/');

$page = 'index';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
$params = [];

switch ($page) {
    case 'index':
        $params['title'] = 'Главная';
        break;

    case 'catalog':
        $params['title'] = 'Каталог';
        $params['catalog'] = getCatalog();
        break;

    case 'about':
        $params['title'] = 'about';
        $params['phone'] = 444333;
        break;


        case 'lesson18':
            $params['title'] = 'Задания';

            $task = $_GET['task'] ?? null;

            if ($task) {
                $params['tasks'] = getTask($task);
            } else {
                $params['tasks'] = getTask();
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['text'])) {
                $params['text'] = $_POST['text'];
                $params['translit'] = getTask_Third($_POST['text']);
            }

            break;

    case 'apicatalog':
        echo json_encode(getCatalog(), JSON_UNESCAPED_UNICODE);
        die();

    default:
        echo "404";
        die();
}

//echo render($page, $params);


function getCatalog() {
    return [
        [
            'name' => 'Яблоко',
            'price' => 24,
            'image' => 'apple.png'
        ],
        [
            'name' => 'Банан',
            'price' => 1,
            'image' => 'banana.png'
        ],
        [
            'name' => 'Апельсин',
            'price' => 12,
            'image' => 'orange.png'
        ],
    ];
}

function getMenu() {
    return [
        [
            'title' => 'Главная',
            'link' => '/engine/',
        ],
        [
            'title' => 'Задания',
            'link' => '/engine/?page=lesson18',
            'children' => [
                ['title' => 'Задание 1', 'link' => '/engine/?page=lesson18&task=one'],
                ['title' => 'Задание 2', 'link' => '/engine/?page=lesson18&task=two'],
                ['title' => 'Задание 3', 'link' => '/engine/?page=lesson18&task=three'],
                ['title' => 'Задание 6', 'link' => '/engine/?page=lesson18&task=six'],
            ]
        ],
        [
            'title' => 'Каталог',
            'link' => '/engine/?page=catalog',
        ],
        [
            'title' => 'О нас',
            'link' => '/engine/?page=about',
        ]
    ];
}

// function render($page, $params = []) {
//     return renderTemplate(LAYOUTS_DIR . 'main', [
//         'title' => $params['title'],
//         'menu' => renderTemplate('menu', ['menus'=> getMenu()] ),
//         'content' => renderTemplate($page, $params)
//     ]);
// }

//$page = 'index';
//
//$params = [
//    'test' => 'test',
//    'title' => 'Главная',
//    'phone' => '+7 495 12-23-12'
//];

function renderTemplate($page, $params = []) {

    /*    foreach ($params as $key => $value) {
            $$key = $value;
        }*/

    extract($params);

    ob_start();
    include TEMPLATES_DIR . $page . ".php";
    return ob_get_clean();
}

//echo renderTemplate('index', $params);

echo renderTemplate(LAYOUTS_DIR . 'main', [
    'title' => $params['title'],
    'menu' => renderTemplate('menu', ['menus' => getMenu()]),
    'content' => renderTemplate($page, $params)
]);



function getTask_One() {
    $i = 0;
    $result = [];
    do {
        if ($i === 0) {
            $result[] = "<p><span class='highlight'>$i</span> – это ноль.</p>";
        } elseif ($i % 2 === 0) {
            $result[] = "<p><span class='highlight'>$i</span> – чётное число.</p>";
        } else {
            $result[] = "<p><span class='highlight'>$i</span> – нечётное число.</p>";
        }
        $i++;
    } while ($i <= 10);
    return $result;
}

function getTask_Two() {
    $result = [];
    $regions = [
        "Московская область" => ["Москва", "Зеленоград", "Клин"],
        "Ленинградская область" => ["Санкт-Петербург", "Всеволожск", "Павловск", "Кронштадт"],
        "Рязанская область" => ["Рязань", "Касимов", "Скопин"],
        "Краснодарский край" => ["Краснодар", "Сочи", "Анапа", "Новороссийск"]
    ];
    foreach ($regions as $region => $cities) {
        $result[] = "<p><span class='highlight'>$region:</span><br>" . implode(", ", $cities) . ".</p>";
    }
    return $result;
}

function getTask_Third($text) {
    $translitMap = [
            'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'yo','ж'=>'zh',
            'з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o',
            'п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'kh','ц'=>'ts',
            'ч'=>'ch','ш'=>'sh','щ'=>'shch','ъ'=>'','ы'=>'y','ь'=>'','э'=>'e','ю'=>'yu','я'=>'ya'
        ];

        $translitMap += array_combine(
            array_map('mb_strtoupper', array_keys($translitMap)),
            array_map('ucfirst', array_values($translitMap))
        );

        return strtr($text, $translitMap);
} 


function getTask_Six() {
    $result = [];
    $regions = [
        "Московская область" => ["Москва", "Зеленоград", "Клин"],
        "Ленинградская область" => ["Санкт-Петербург", "Всеволожск", "Павловск", "Кронштадт"],
        "Рязанская область" => ["Рязань", "Касимов", "Скопин"],
        "Краснодарский край" => ["Краснодар", "Сочи", "Анапа", "Новороссийск"]
    ];

    foreach ($regions as $region => $cities) {
        // Фильтруем города, оставляя только те, что начинаются с "К"
        $filteredCities = array_filter($cities, function($city) {
            return mb_substr($city, 0, 1) === 'К';
        });

        // Если в регионе остались города после фильтрации — выводим
        if (!empty($filteredCities)) {
            $result[] = "<p><span class='highlight'>$region:</span><br>" . implode(", ", $filteredCities) . ".</p>";
        }
    }

    return $result;
}


function getTask($task = '') {
    $allTasks = [];
    switch($task){
        case 'one':
            $allTasks[] = getTask_One();
            break;
        case 'two':
            $allTasks[] = getTask_Two();
            break;
        case 'three':
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['text'])) {
                $allTasks[] = [getTask_Third($_POST['text'])];
            }
            break;
        case 'six':
            $allTasks[] = getTask_Six();
            break;
        default:
            $allTasks[] = getTask_One();
            $allTasks[] = getTask_Two();
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['text'])) {
                $allTasks[] = [getTask_Third($_POST['text'])];
            }
            $allTasks[] = getTask_Six();
            return $allTasks;
            die();
    } 
    return $allTasks;
}