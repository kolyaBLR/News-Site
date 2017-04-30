<?php

namespace AppBundle\Entity;

class NewsRepository extends \Doctrine\ORM\EntityRepository
{
    public function getNewsSearchByIndexPage($page)
    {
        $countNews = ($page - 1) * 5;
        return $this->getEntityManager()
            ->createQuery("
              SELECT n.id, n.category, n.titleText, n.content, u.firstName, u.lastName, n.datePublication
              FROM AppBundle:DataUser u INNER JOIN AppBundle:DataNews n
              WITH n.idAuthor = u.id")
            ->setMaxResults(5)
            ->setFirstResult($countNews)->getResult();
    }

    public function getNewsSearchByCategory($page, $category)
    {
        $countNews = ($page - 1) * 5;
        return $this->getEntityManager()
            ->createQuery("
              SELECT n.id, n.category, n.titleText, n.content, u.firstName, u.lastName, n.datePublication
              FROM AppBundle:DataUser u INNER JOIN AppBundle:DataNews n
              WITH n.idAuthor = u.id
              WHERE n.category = '$category'")
            ->setMaxResults(5)
            ->setFirstResult($countNews)->getResult();
    }

    public function getCountNews()
    {
        return $this->getEntityManager()
            ->createQuery("SELECT count (n) FROM AppBundle:DataNews n")
            ->getResult()[0][1];
    }
}