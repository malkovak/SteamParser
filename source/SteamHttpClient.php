<?php
/**
 * Created by PhpStorm.
 * User: kseniyamalkova
 * Date: 08.04.16
 * Time: 16:57
 */


class SteamHttpClient
{
    // method for getting catalog of games
    public static function getAllApps() {
        $client = new GuzzleHttp\Client();
        $response = $client->get('http://api.steampowered.com/ISteamApps/GetAppList/v2');
        $body = $response->getBody();
        return json_decode($body)->{"applist"}->{"apps"};
    }

    // method for getting game by id
    public static function  getGame($id){
        if (is_int($id) && $id > 0)
        {
            $client = new GuzzleHttp\Client();
            $can_continue = false;
            $response = null;
            while (!$can_continue) {
                try {
                    $response = $client->get('http://store.steampowered.com/api/appdetails/?appids='.$id);
                    $can_continue = true;
                } catch (Exception $e) {
                    //Steam api return error, because of query count excess
                    sleep(10);
                    $can_continue = false;
                }
            }
            return json_decode($response->getBody())->{$id};
        }
        else {
            return null;
        }
    }
}


