<?php
/**
 * Created by PhpStorm.
 * User: kseniyamalkova
 * Date: 08.04.16
 * Time: 18:56
 */


/**
 * @Entity @Table(name="games")
 **/
class Game
{
    /** @Id @Column(type="integer") **/
    protected $id;
    /** @Column(type="string") **/
    protected $name;
    /** @Column(type="text") **/
    protected $description;
    /** @Column(type="text") **/
    protected $about_the_game;
    /** @Column(type="string") **/
    protected $release_date;

    /**
     * @ManyToMany(targetEntity="Developer")
     * @JoinTable(name="games_developers",
     *      joinColumns={@JoinColumn(name="game_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="developer_id", referencedColumnName="id")}
     *      )
     */
    protected $developers;

    /**
     * @ManyToMany(targetEntity="Genre")
     * * @JoinTable(name="games_genres",
     *      joinColumns={@JoinColumn(name="game_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="genre_id", referencedColumnName="id")}
     *      )
     */
    protected $genres;
    public function __construct($id,$name, $description, $about_the_game, $release_date) {
        $this->developers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->genres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->about_the_game = $about_the_game;
        $this->release_date = $release_date;
    }
    
    public function getDevelopers()
    {
        return $this->developers;
    }

    public function getGenres()
    {
        return $this->genres;
    }
    
}