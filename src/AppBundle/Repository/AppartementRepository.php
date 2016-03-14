<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class AppartementRepository extends EntityRepository
{
    public function getAppartements($page = 1, $nbPerPage = 10)
    {
        $query = $this->createQueryBuilder('a')
            ->leftJoin('a.photos', 'p')
            ->addSelect('p')
            ->getQuery()
        ;

        $query
            ->setFirstResult(($page-1) * $nbPerPage)
            ->setMaxResults($nbPerPage)
        ;

        return new Paginator($query, true);
    }
}