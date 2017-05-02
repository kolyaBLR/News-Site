<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

class TokenUserRepository extends EntityRepository
{
    public function getTokenSearchByEmail($email)
    {
        return $this->getEntityManager()
            ->createQuery("SELECT u FROM AppBundle:TokenUser u WHERE u.email = '$email'")
            ->getResult()[0];
    }
}