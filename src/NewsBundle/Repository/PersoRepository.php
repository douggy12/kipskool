<?php

namespace NewsBundle\Repository;

/**
 * PersoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PersoRepository extends \Doctrine\ORM\EntityRepository
{
    public function findWithMotCle($motcle){
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.prenom LIKE :motcle')
            ->setParameter('motcle',  '%'.$motcle.'%')
            ->orWhere('p.nom LIKE :motcle')
            ->setParameter('motcle', '%'.$motcle.'%')
            ->getQuery()
            ;
    }

}
