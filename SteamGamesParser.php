<?php
/**
 * Created by PhpStorm.
 * User: kseniyamalkova
 * Date: 09.04.16
 * Time: 19:23
 */
require_once "SteamHttpClient.php";
require_once "Database.php";
require_once "bootstrap.php";


//полуение списка всех приложений (appid, name)
$games = SteamHttpClient::getAllApps();
foreach ($games as $game) {
    //получение информации об игре
    $gameInfo = SteamHttpClient::getGame($game->{"appid"});
    if ($gameInfo->{"success"}) {
        $info = $gameInfo->{"data"};
        if ($info->{"type"}=="game") addToDatabase($info, $game->{"appid"}, $entityManager);
    }

}


function addToDatabase($data, $id, $entityManager) {
        $database = new Database($entityManager);
        $database->addGame($id, $data->{"name"}, $data->{"detailed_description"}, $data->{"about_the_game"},
            $data->{"release_date"}->{"date"},$data->{"developers"}, $data->{"genres"} );
        
}