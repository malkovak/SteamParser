<?php
/**
 * Created by PhpStorm.
 * User: kseniyamalkova
 * Date: 09.04.16
 * Time: 15:20
 */
require_once "bootstrap.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);