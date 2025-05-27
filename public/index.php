<?php
// public/index.php

// Определяем корневую директорию проекта (один уровень выше public)
define('ROOT', dirname(__DIR__));

// Подключаем автозагрузчик Composer
require_once ROOT . '../vendor/autoload.php';

// Подключаем контроллеры
require_once __DIR__ . '/controllers/MainController.php';
require_once __DIR__ . '/../controllers/JediController.php';
require_once ROOT . '/controllers/SithController.php';
require_once ROOT . '/controllers/CharacterController.php';
require_once ROOT . '/controllers/ErrorController.php';

// Получаем URL запроса
$url = $_SERVER['REQUEST_URI'];

// Создаем экземпляры контроллеров
$mainController = new MainController();
$jediController = new JediController();
$sithController = new SithController();
$characterController = new CharacterController();
$errorController = new ErrorController();

// Разрешённые персонажи по группам
$allowedJedi = ['obi-wan', 'ahsoka', 'kel-kestis', 'anakin'];
$allowedSith = ['vader', 'maul', 'dooku', 'starkiller'];

// Простая маршрутизация
if ($url === '/' || $url === '/index.php') {
    // Главная страница
    $mainController->index();
} elseif (preg_match('#^/jedi#', $url)) {
    // Страница джедаев
    $jediController->index();
} elseif (preg_match('#^/sith#', $url)) {
    // Страница ситхов
    $sithController->index();
} elseif (preg_match('#^/characters/([a-zA-Z0-9\-]+)$#', $url, $matches)) {
    // Страница персонажа
    $slug = $matches[1];

    if (in_array($slug, $allowedJedi)) {
        $characterController->show($slug, 'jedi');
    } elseif (in_array($slug, $allowedSith)) {
        $characterController->show($slug, 'sith');
    } else {
        $errorController->notFound();
    }
} else {
    // Страница 404
    $errorController->notFound();
}
