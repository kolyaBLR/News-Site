<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

class UserRepository extends EntityRepository
{
    public function getUserSearchByEmail($email)
    {
         $user = $this->getEntityManager()
            ->createQuery("SELECT p FROM AppBundle:DataUser p WHERE p.email = '$email'")
            ->getResult();
        return $user[0];
    }

    public function getUserSubscriptionEmail()
    {
        return $this->getEntityManager()
            ->createQuery("SELECT u.firstName, u.lastName, u.email
              FROM AppBundle:DataUser u
              WHERE u.subscriptionEmail = TRUE")
            ->getResult();
    }

    public function getUserSearchByPage($countUsers, $indexPage)
    {
        $indexPage -= 1;
        return $this->getEntityManager()
            ->createQuery("
              SELECT u 
              FROM AppBundle:DataUser u
              ")
            ->setMaxResults($countUsers)
            ->setFirstResult($indexPage)->getResult();
    }

    public function getCountPage($countUsersPage)
    {
        return $this->getEntityManager()
                ->createQuery("SELECT count (n) FROM AppBundle:DataUSer n")
                ->getResult()[0][1] / $countUsersPage;
    }
}