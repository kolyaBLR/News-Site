<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 * @ORM\Table(name="data_user")
 * @UniqueEntity(fields="email", message="This email is already used")
 */
class DataUser
{
    public function __construct()
    {

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
     * @ORM\Column(name="first_name", type="string", length = 128)
     * @Assert\NotBlank()
     */
    private $firstName;
    public function getFirstName()
    {
        return $this->firstName;
    }
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @ORM\Column(name="last_name",type="string", length = 128)
     * @Assert\NotBlank()
     */

    private $lastName;
    public function getLastName()
    {
        return $this->lastName;
    }
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @ORM\Column(name="password",type="string", length = 4096)
     * @Assert\NotBlank()
     */
    private $password;
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @ORM\Column(name="email",type="string", length = 128)
     * @Assert\NotBlank()
     */
    private $email;
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @ORM\Column(name="access_level", type="string", length = 32);
     *
     */
    private $userLevelAccess;
    public function getUserLevelAccess()
    {
        return $this->userLevelAccess;
    }
    public function setUserLevelAccess()
    {
        $this->userLevelAccess = 'Normal';
    }
}
