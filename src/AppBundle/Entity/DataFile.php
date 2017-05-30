<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraint as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="data_file")
 */
class DataFile
{
    /**
     * @ORM\Column(name="id", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="file", type="string")
     * @Assert\NotBlank(message="Please, upload the product brochure as a file.")
     * @Assert\File(
     *     mimeTypes = {"text/plain", "text/html"},
     *     mimeTypesMessage = "Please upload a valid file"
     * )
     */
    private $file;

    public function getId()
    {
        return $this->id;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile(File $file)
    {
        $this->file = $file;
    }
}