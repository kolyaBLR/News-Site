<?php

namespace AppBundle\Entity;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NewsPerository extends \Doctrine\ORM\EntityRepository
{
    public function addNews(DataNews $news)
    {
        $manager = $this->getEntityManager();
        $manager->persist($news);
        $manager->flush();
    }
}
