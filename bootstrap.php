<?php
/**
 * Created by PhpStorm.
 * User: kseniyamalkova
 * Date: 09.04.16
 * Time: 14:15
 */
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/models"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_pgsql',
    'host' => '127.0.0.1',
    'dbname' => 'SteamGames',
    'charset' => 'utf8',

);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);