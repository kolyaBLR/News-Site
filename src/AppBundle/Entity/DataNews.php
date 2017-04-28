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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DataUser")
     * @ORM\Column(name="id_author", type="integer")
     * @ORM\JoinColumn(name="id_author", referencedColumnName="id")
     */
    private $idAuthor;

    /**
     * @ORM\Column(name="title_text",type="string", length = 128)
     * @Assert\NotBlank()
     */
    private $titleText;

    /*
     * @ORM\Column(name="title_image",type="string")
     * @Assert\Image(mimeTypes={ "image/*" })
     */
    //private $titleImage;

    /**
     * @ORM\Column(name="content",type="string")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\NewsCategory")
     * @ORM\Column(name="category",type="string")
     * @ORM\JoinColumn(name="category", referencedColumnName="category")
     * @Assert\NotBlank()
     */
    private $category;

    /*
     * @ORM\Column(name="date",type="datetime")
     * @Assert\NotBlank()
     */
    //private $dataPublication;

    /**
     * @ORM\Column(name="view_count",type="integer")
     * @Assert\NotBlank()
     */
    private $viewCount = 0;

    /*public function __construct(
        int $idAuthor,
        string $titleText,
        string $titleImage,
        string $content,
        string $category,
        $dataPublication,
        int $viewCount
    )
    {
        $this->idAuthor = $idAuthor;
        $this->titleText = $titleText;
        $this->titleImage = $titleImage;
        $this->content = $content;
        $this->category = $category;
        $this->dataPublication = $dataPublication;
        $this->viewCount = $viewCount;
    }*/

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

   /* public function getTitleImage()
    {
        return $this->titleImage;
    }

    public function setTitleImage(string $titleImage)
    {
        $this->titleImage = $titleImage;
    }*/

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

    /*public function getDataPublication()
    {
        return $this->dataPublication;
    }

    public function setDataPublication($dataPublication)
    {
        $this->dataPublication = $dataPublication;
    }*/

    public function getViewCount()
    {
        return $this->viewCount;
    }

    public function setViewCount()
    {
        $this->viewCount += 1;
    }
}
