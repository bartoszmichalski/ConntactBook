<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ConntactRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ConntactRepository extends EntityRepository
{
    public function findAllASC()
    {
        $conntacts=$this->
        getEntityManager()->
        createQuery('SELECT b FROM AppBundle:Conntact b order by b.name ASC')->
        getResult();

        return $conntacts;
    }
}