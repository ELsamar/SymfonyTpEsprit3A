<?php

namespace Esprit\ParcBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class Voiture
 * @ORM\Entity(repositoryClass="Esprit\ParcBundle\Entity\VoitureRepository")
 */
class Voiture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string",length=40)
     */
    private $serie;
    /**
     * @ORM\Column(type="string",length=40)
     */
    private $marque;
    /**
     * @ORM\Column(type="date")
     */
    private $datedemisecirculation;
    /**
     * @ORM\ManyToOne(targetEntity="Modele")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $Modele ;
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
    public function setId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * @param mixed $serie
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;
    }

    /**
     * @return mixed
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * @param mixed $marque
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    /**
     * @return mixed
     */
    public function getDatedemisecirculation()
    {
        return $this->datedemisecirculation;
    }

    /**
     * @param mixed $datedemisecirculation
     */
    public function setDatedemisecirculation($datedemisecirculation)
    {
        $this->datedemisecirculation = $datedemisecirculation;
    }

    /**
     * @return mixed
     */
    public function getModele()
    {
        return $this->Modele;
    }

    /**
     * @param mixed $Modele
     */
    public function setModele($Modele)
    {
        $this->Modele = $Modele;
    }

}
