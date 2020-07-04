<?php
/**
 * Created by PhpStorm.
 * User: samar
 * Date: 10/16/2018
 * Time: 2:55 PM
 */

namespace Esprit\ParcBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;


/**
 * Class Modele
 * @ORM\Entity(repositoryClass="Esprit\ParcBundle\Entity\ModeleRepositery")
 */
class Modele
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $libelle;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $pays;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     * @return Modele
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param mixed $pays
     * @return Modele
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
        return $this;
    }

}