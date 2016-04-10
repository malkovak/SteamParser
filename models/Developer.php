<?php
/**
 * Created by PhpStorm.
 * User: kseniyamalkova
 * Date: 08.04.16
 * Time: 19:22
 */

/**
 * @Entity @Table(name="developers") 
 **/

class Developer
{
    /** @Id @Column(type="integer") @GeneratedValue**/
    protected $id;
    /** @Column(type="string") **/
    protected $name;


    public function __construct($name) {
        $this->name = $name;

    }

    
}