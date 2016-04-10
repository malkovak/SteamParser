<?php



date_default_timezone_set('Europe/Moscow');
require_once 'vendor/autoload.php';
require_once 'bootstrap.php';
require_once 'source/SteamGamesCSVCreator.php';


$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

$app = new Silex\Application();
$app['debug'] = true;
$file_dir = (new SteamGamesCSCreator($entityManager))->getFilePath();


// /GetGames return link on csv file with data about games
$app->get('/GetGames', function() {
    $csv = "";
    return $csv;
});

$app->run();


