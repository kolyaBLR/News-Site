<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

class UserRepository extends EntityRepository
{
    public function getUserSearchByEmail($email)
    {
        return $this->getEntityManager()
            ->createQuery("SELECT p FROM AppBundle:DataUser p WHERE p.email = '$email'")
            ->getResult();
    }
}