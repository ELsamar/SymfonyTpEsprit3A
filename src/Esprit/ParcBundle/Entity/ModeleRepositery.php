<?php
/**
 * Created by PhpStorm.
 * User: samar
 * Date: 11/1/2018
 * Time: 12:09 PM
 */

namespace Esprit\ParcBundle\Entity;
use Doctrine\ORM\EntityRepository;

class ModeleRepositery extends EntityRepository
{
    public function findByPays($pays)
    {
        $querry =$this->createQueryBuilder('m')
            ->where('m.pays=:pays')
            ->setParameter('pays',$pays);
        return $querry->getQuery()->getResult();
    }
    public function findByPaysParametre($pays)
{
    $querry=$this->getEntityManager()
        ->createQuery("SELECT m FROM EspritParcBundle:Modele m where m.pays=:pays")
        ->setParameter('pays',$pays);
    return $querry->getResult();
}



}