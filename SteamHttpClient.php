<?php
/**
 * Created by PhpStorm.
 * User: kseniyamalkova
 * Date: 08.04.16
 * Time: 16:57
 */


class SteamHttpClient
{
    // метод для получения каталога игр (id, name)
    public static function getAllApps() {
        $client = new GuzzleHttp\Client();
        $response = $client->get('http://api.steampowered.com/ISteamApps/GetAppList/v2');
        $body = $response->getBody();
        return json_decode($body)->{"applist"}->{"apps"};
    }

    // метод для получения игры по id
    public static function  getGame($id){
        /**$client = new GuzzleHttp\Client(['base_uri' => 'http://store.steampowered.com/api/']);
        $response = $client->request('GET', 'appdetails/?appids=' . $id);
        $body = $response->getBody();
        
        return json_decode($body)->{$id};**/
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


