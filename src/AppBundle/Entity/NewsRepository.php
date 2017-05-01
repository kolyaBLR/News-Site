<?php

namespace AppBundle\Entity;

class NewsRepository extends \Doctrine\ORM\EntityRepository
{
    public function getNewsSearchByIndexPageCategory($page = '1', $category = '')
    {
        $category = $category == '' ? '' : "n.category = '$category' AND";
        $countNews = ($page - 1) * 5;
        return $this->getEntityManager()
            ->createQuery("
              SELECT n.id, n.category, n.titleText, n.content, u.firstName, 
              u.lastName, n.datePublication, n.idAuthor, n.viewCount
              FROM AppBundle:DataUser u INNER JOIN AppBundle:DataNews n
              WITH n.idAuthor = u.id
              WHERE $category n.idAuthor = u.id")
            ->setMaxResults(5)
            ->setFirstResult($countNews)->getResult();
    }

    public function getCountPage($catehory = '')
    {
        return $this->getEntityManager()
            ->createQuery("SELECT count (n) FROM AppBundle:DataNews n
              WHERE n.category = '$catehory'")
            ->getResult()[0][1] / 5;
    }

    public function getOneNewsSearchByIdAuthor($idNews, $idAuthor)
    {
        $news = $this->getEntityManager()
            ->createQuery("
              SELECT n.id, n.category, n.titleText, n.content, u.firstName, 
              u.lastName, n.datePublication
              FROM AppBundle:DataUser u INNER JOIN AppBundle:DataNews n
              WITH n.idAuthor = u.id
              WHERE n.idAuthor = $idAuthor AND n.id = $idNews")
            ->getResult();
         return $news[0];
    }
}