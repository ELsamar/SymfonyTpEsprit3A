<?php
/**
 * Created by PhpStorm.
 * User: samar
 * Date: 11/8/2018
 * Time: 9:44 AM
 */

namespace Esprit\ParcBundle\Entity;
use Doctrine\ORM\EntityRepository;

class VoitureRepository extends EntityRepository
{
    public function findByDateVoiture()
    {
        //$date= Current_Date();
        $querry=$this->getEntityManager()
            ->createQuery("SELECT v FROM EspritParcBundle:Voiture v 
            where v.datedemisecirculation >= Current_Date()
            ORDER BY v.id DESC");

        return $querry->getResult();
    }
    public function findByCountry()
    {
        $querry=$this->getEntityManager()
            ->createQuery("SELECT v FROM  EspritParcBundle:Voiture v 
                  Join   v.Modele m where m.pays= 'France' and v.datedemisecirculation >= Current_Date()
                    ORDER BY v.id DESC");
        return $querry->getResult();
    }
    public function findBySerie($serie)
    {
        $querry=$this->getEntityManager()
            ->createQuery("SELECT v FROM EspritParcBundle:Voiture v 
            where v.serie =: serie
            ORDER BY v.id DESC")
        ->setParameter('serie',$serie);
        return $querry->getResult();
    }
}