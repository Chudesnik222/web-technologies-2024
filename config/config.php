<?php
define('BASE_PATH', realpath(__DIR__ . '/..'));
define('TEMPLATES_DIR', BASE_PATH . '/templates/');
define('LAYOUTS_DIR', 'layouts/');

include __DIR__ . "/../engine/bux.php";
include __DIR__ . "/../engine/functions.php";
include __DIR__ . "/../engine/catalog.php";
include __DIR__ . "/../engine/log.php";