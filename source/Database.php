<?php
/**
 * Created by PhpStorm.
 * User: kseniyamalkova
 * Date: 08.04.16
 * Time: 17:51
 */
require_once "models/Game.php";
require_once "models/Developer.php";
require_once "models/Genre.php";



class Database
{

    protected $em;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function addGame($id, $name, $description, $about, $release_date, $developers, $genres)
    {
        //add game to database (in table - games)
        $game = new Game($id, $name, $description, $about, $release_date);
        //add developers to database if they are not yet there and set relationships with game
        foreach ($developers as $dev) {
            $developer_in_db = $this->em->getRepository("Developer")->findOneBy(array('name' => $dev));
            if ($developer_in_db == null) {
                $developer_in_db = new Developer($dev);
                $this->em->persist($developer_in_db);
                $this->em->flush();
            }
            //add developer to game
            $game->getDevelopers()->add($developer_in_db);
        }
        //add genres to database if they are not yet there and set relationships with game
        foreach ($genres as $g) {
            $genre_in_db = $this->em->getRepository("Genre")->findOneBy(array('id' => $g->{"id"}));
            if ($genre_in_db == null) {
                $genre_in_db = new Genre($g->{"id"}, $g->{"description"});
                $this->em->persist($genre_in_db);
                $this->em->flush();
            }
            //add genre to game
            $game->getGenres()->add($genre_in_db);
        }
        $this->em->persist($game);
        $this->em->flush();
    }
}