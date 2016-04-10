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
        $game = new Game($id, $name, $description, $about, $release_date); //вот тут ты добавилу игру в БД без жанров и разрабов



        foreach ($developers as $dev) {

            $developer_in_db = $this->em->getRepository("Developer")->findOneBy(array('name' => $dev));
            if ($developer_in_db == null) {
                $developer_in_db = new Developer($dev);
                $this->em->persist($developer_in_db);
                $this->em->flush();
            }


            $game->getDevelopers()->add($developer_in_db);

            //$this->em->flush();

        }

        foreach ($genres as $g) {

            $genre_in_db = $this->em->getRepository("Genre")->findOneBy(array('id' => $g->{"id"}));
            if ($genre_in_db == null) {
                $genre_in_db = new Genre($g->{"id"}, $g->{"description"});
                $this->em->persist($genre_in_db);
                $this->em->flush();
            }
            $game->getGenres()->add($genre_in_db);
            //$this->em->flush();
        }
        $this->em->persist($game);
        $this->em->flush();
    }
}