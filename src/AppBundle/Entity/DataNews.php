<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\NewsRepository")
 * @ORM\Table(name="data_news")
 */
class DataNews
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="id_author", type="integer")
     * @Assert\NotBlank()
     */
    private $idAuthor;

    /**
     * @ORM\Column(name="title_text",type="string", length = 128)
     * @Assert\NotBlank()
     */
    private $titleText;

    /**
     * @ORM\Column(name="content",type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @ORM\Column(name="category",type="string")
     * @Assert\NotBlank()
     */
    private $category;

    /**
     * @ORM\Column(name="date",type="string", length = 64)
     * @Assert\NotBlank()
     */
    private $datePublication;

    /**
     * @ORM\Column(name="view_count",type="integer")
     * @Assert\NotBlank()
     */
    private $viewCount = 0;

    /**
     * @ORM\Column(name="$link_news_1", type="string", nullable=true)
     */
    private $linkNews1 = '';

    /**
     * @ORM\Column(name="$link_news_2", type="string", nullable=true)
     */
    private $linkNews2 = '';

    /**
     * @ORM\Column(name="$link_news_3", type="string", nullable=true)
     */
    private $linkNews3 = '';

    /**
     * @ORM\Column(name="$link_news_4", type="string", nullable=true)
     */
    private $linkNews4 = '';

    /**
     * @ORM\Column(name="$link_news_5", type="string", nullable=true)
     */
    private $linkNews5 = '';

    public function getId()
    {
        return $this->id;
    }

    public function getIdAuthor()
    {
        return $this->idAuthor;
    }

    public function setIdAuthor(int $idAuthor)
    {
        $this->idAuthor = $idAuthor;
    }

    public function getTitleText()
    {
        return $this->titleText;
    }

    public function setTitleText(string $titleText)
    {
        $this->titleText = $titleText;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(NewsCategory $category)
    {
        $this->category = $category->getCategory();
    }

    public function getDatePublication()
    {

        return $this->datePublication;
    }

    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;
    }

    public function getViewCount()
    {
        return $this->viewCount;
    }

    public function setViewCount()
    {
        $this->viewCount += 1;
    }

    public function getLinkNews1()
    {
        return $this->linkNews1;
    }

    public function setLinkNews1($linkNews)
    {
        $this->linkNews1 = $linkNews;
    }

    public function getLinkNews2()
    {
        return $this->linkNews2;
    }

    public function setLinkNews2($linkNews)
    {
        $this->linkNews2 = $linkNews;
    }

    public function getLinkNews3()
    {
        return $this->linkNews3;
    }

    public function setLinkNews3($linkNews)
    {
        $this->linkNews3 = $linkNews;
    }

    public function getLinkNews4()
    {
        return $this->linkNews4;
    }

    public function setLinkNews4($linkNews)
    {
        $this->linkNews4 = $linkNews;
    }

    public function getLinkNews5()
    {
        return $this->linkNews5;
    }

    public function setLinkNews5($linkNews)
    {
        $this->linkNews5 = $linkNews;
    }
}
