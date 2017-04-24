<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\NewsCategoryRepository")
 * @ORM\Table(name="news_category")
 * @UniqueEntity(fields="category", message="This category is already used")
 */
class NewsCategory
{
    /**
     * @ORM\Column(name="id", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\Column(name="category", type="string", length=128, unique=true)
     */
    private $category;
    public function getCategory()
    {
        return $this->category;
    }
    public function setCategory($category)
    {
        $this->category=$category;
    }
}
