<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 * @ORM\Table(name="data_user")
 * @UniqueEntity(fields="email", message="This email is already used")
 */
class DataUser implements UserInterface
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
    public function setId()
    {
        $this->id;
    }
    /**
     * @ORM\Column(name="user_name", type="string", length = 128)
     * @Assert\NotBlank()
     */
    private $userName;
    public function getUserName()
    {
        return $this->userName;
    }
    public function setUserName(string $userName)
    {
        $this->userName = $userName;
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
     *
     * @Assert\Length(max=4096)
     */
    private $plainPassword;
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    public function setPlainPassword(string $plainPassword)
    {
        $this->password = $plainPassword;
    }

    /**
     * @ORM\Column(name="password",type="string", length=64)
     *
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
     * @ORM\Column(name="email",type="string", length = 128, unique=true)
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
    private $getRoles;
    public function getRoles()
    {
        return $this->getRoles;
    }
    public function setRoles()
    {
        $this->getRoles = 'ROLE_USER';
    }
    public function getSalt()
    {
        return null;
    }
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * Set getRoles
     *
     * @param string $getRoles
     *
     * @return DataUser
     */
    public function setGetRoles($getRoles)
    {
        $this->getRoles = $getRoles;

        return $this;
    }

    /**
     * Get getRoles
     *
     * @return string
     */
    public function getGetRoles()
    {
        return $this->getRoles;
    }
}
