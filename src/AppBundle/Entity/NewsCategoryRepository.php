<?php

namespace AppBundle\Entity;

class NewsCategoryRepository extends \Doctrine\ORM\EntityRepository
{
    public function getCategorySearchByName($name)
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT c 
                FROM AppBundle:NewsCategory c 
                WHERE c.category = '$name'")
            ->getResult()[0];
    }
}