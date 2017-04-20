<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\NewsRepository")
 * @ORM\Table(name="data_news")
 */
class DataNews
{
    public function __construct(
        string $idAuthor,
        string $titleText,
        string $titleImage,
        string $content
    )
    {
        $this->idAuthor = $idAuthor;
        $this->titleText = $titleText;
        $this->titleImage = $titleImage;
        $this->content = $content;
    }

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    public function getId()
    {
        return $this->id;
    }
    public function setId()
    {
        $this->id;
    }

    /**
     * @ORM\Column(name="id_author", type="integer")
     * @Assert\NotBlank()
     */
    private $idAuthor;
    public function getIdAuthor()
    {
        return $this->idAuthor;
    }
    public function setIdAuthor(int $idAuthor)
    {
        $this->idAuthor = $idAuthor;
    }

    /**
     * @ORM\Column(name="title_text",type="string", length = 128)
     * @Assert\NotBlank()
     */
    private $titleText;
    public function getTitleText()
    {
        return $this->titleText;
    }
    public function setTitleText(string $titleText)
    {
        $this->titleText = $titleText;
    }

    /**
     * @ORM\Column(name="title_image",type="string")
     * @Assert\NotBlank()
     */
    private $titleImage;
    public function getTitleImage()
    {
        return $this->titleImage;
    }
    public function setTitleImage(string $titleImage)
    {
        $this->titleImage = $titleImage;
    }

    /**
     * @ORM\Column(name="content",type="string")
     * @Assert\NotBlank()
     */
    private $content;
    public function getContent()
    {
        return $this->content;
    }
    public function setContent(string $content)
    {
        $this->content = $content;
    }
}