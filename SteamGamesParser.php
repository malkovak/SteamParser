<?php
/**
 * Created by PhpStorm.
 * User: kseniyamalkova
 * Date: 09.04.16
 * Time: 19:23
 */
require_once "source/SteamHttpClient.php";
require_once "source/Database.php";
require_once "bootstrap.php";


//get all Steam apps
$games = SteamHttpClient::getAllApps();
foreach ($games as $game) {
    //get information about game
    $gameInfo = SteamHttpClient::getGame($game->{"appid"});
    if ($gameInfo->{"success"}) {
        $info = $gameInfo->{"data"};
        //if type of app is game then add this game to database
        if ($info->{"type"}=="game") addToDatabase($info, $game->{"appid"}, $entityManager);
    }

}

function addToDatabase($data, $id, $entityManager) {
        $database = new Database($entityManager);
        $database->addGame($id, $data->{"name"}, $data->{"detailed_description"}, $data->{"about_the_game"},
            $data->{"release_date"}->{"date"},$data->{"developers"}, $data->{"genres"} );
        
}