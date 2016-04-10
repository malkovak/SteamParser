<?php
/**
 * Created by PhpStorm.
 * User: kseniyamalkova
 * Date: 08.04.16
 * Time: 19:16
 */

/**
 * @Entity @Table(name="genres")
 **/
class Genre
{
    /** @Id @Column(type="integer")  **/
    protected $id;
    /** @Column(type="string") **/
    protected $description;

    /**
     * @ManyToMany(targetEntity="Game", mappedBy="genres")
     */
    
    public function __construct($id,$description)
    {
        $this->description = $description;
        $this->id = $id;
    }

  
}