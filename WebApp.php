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
$file_path = (new SteamGamesCSVCreator($entityManager))->getFile();


$app->get('/', function () use ($app) {
    return "Get Steam Games in CSV: <br><a href='/GetGames'>/Games</a>";
    });




// /GetGames return link on csv file with data about games
$app->get('/GetGames', function() use ($file_path) {
    $file = __DIR__."/". $file_path;
    $response = new \Symfony\Component\HttpFoundation\Response();
    $response->headers->set('Cache-Control', 'private');
    $response->headers->set('Content-type', mime_content_type($file));
    $response->headers->set('Content-Disposition', 'attachment; filename="' . basename($file) . '";');
    $response->sendHeaders();
    $response->setContent(file_get_contents($file));
    return $response;
});

$app->run();


