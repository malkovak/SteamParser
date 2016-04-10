<?php


class SteamGamesCSVCreator
{
    protected $entityManager;
    public function __construct(\Doctrine\ORM\EntityManager $entityManager) {
    $this->entityManager = $entityManager;
    //Get steam games from database
    $steam_games = $this->getSteamGames();
    //Make csv file based on array of games
    $this->createCSV($steam_games);
}

    public function getFile() {
        return 'data/games.csv';
    }
    private function getSteamGames() {
        $sql = "SELECT games.name, games.about_the_game,".
        "games.release_date, string_agg(developers.name, ',') as developers, ".
        "string_agg(genres.description, ',') as genres ".
        "FROM games ".
        "JOIN games_developers ".
        "ON games.id = games_developers.game_id ".
        "JOIN developers ".
        "ON developers.id = games_developers.developer_id ".
        "JOIN games_genres ".
        "ON games.id = games_genres.game_id ".
        "JOIN genres ".
        "ON genres.id = games_genres.genre_id ".
        "GROUP BY games.id;";
        $stmt = $this->entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    private function createCSV($steam_games_array) {
        $fp = fopen('data/games.csv', 'w');
        //fix for UTF-8 Excel
        fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
        //Captions
        fputcsv($fp, array("Game","Description", "Release date", "Developers", "Genres"), ';');
        //Filling CSV
        foreach ($steam_games_array as $row) {
            fputcsv($fp, $row, ';');
        }
        fclose($fp);
    }
}