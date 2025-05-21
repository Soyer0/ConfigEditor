<?php
require __DIR__ . '/config/config.php';
require __DIR__ . '/controllers/Controller.php';

session_start();

if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'en';
}

if (!isset($_SESSION['all_languages'])) {
    $_SESSION['all_languages'] = ['en'];
}

if (!isset($GLOBALS['multilanguage_type'])) {
    $GLOBALS['multilanguage_type'] = 'main domain';
}

$controller = new Controller();

$action = $_GET['action'] ?? 'showConfig';

switch ($action) {
    case 'showConfig':
        $controller->showConfig();
        break;
    case 'saveConfig':
        $controller->saveConfig();
        break;
    default:
        echo "404 Not Found";
        break;
}



