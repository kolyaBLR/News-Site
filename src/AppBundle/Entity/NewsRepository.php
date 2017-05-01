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
              SELECT n.id, n.category, n.titleText, n.nameNews, u.firstName, 
              u.lastName, n.datePublication, n.idAuthor, n.viewCount
              FROM AppBundle:DataUser u INNER JOIN AppBundle:DataNews n
              WITH n.idAuthor = u.id
              WHERE $category n.idAuthor = u.id")
            ->setMaxResults(5)
            ->setFirstResult($countNews)->getResult();
    }

    public function getCountPage($category = '')
    {
        $category = $category == '' ? '' : "WHERE n.category = '$category'";
        return $this->getEntityManager()
            ->createQuery("SELECT count (n) FROM AppBundle:DataNews n $category")
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

    public function getLastNewsGroupId()
    {
        return $this->getEntityManager()
            ->createQuery('
              SELECT n.titleText, n.nameNews, n.id, n.idAuthor
              FROM AppBundle:DataNews n
              ORDER BY n.datePublication DESC')
            ->setMaxResults(5)
            ->getResult();
    }
}