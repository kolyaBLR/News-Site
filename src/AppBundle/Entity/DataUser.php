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
     */
    private $roles;
    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles($roles='ROLE_USER')
    {
        $this->roles = $roles;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {

    }


    /**
     * @ORM\Column(name="subscription_email", type="boolean");
     */
    private $subscriptionEmail;
    public function getSubscriptionEmail()
    {
        return $this->subscriptionEmail;
    }
    public function setSubscriptionEmail($subscriptionEmail = false)
    {
        $this->subscriptionEmail = $subscriptionEmail;
    }
}
