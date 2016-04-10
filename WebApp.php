<?php



date_default_timezone_set('Europe/Moscow');
require_once 'vendor/autoload.php';
require_once 'bootstrap.php';
require_once 'SteamGamesParser.php';


$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

$app = new Silex\Application();
$app['debug'] = true;


// /GetGames возвращает csv файл с данными о приложениях
$app->get('/GetGames', function() {

    //Получение данных в формате csv 
    $csv = "";
    return $csv;
});

$app->run();


