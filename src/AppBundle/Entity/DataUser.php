<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 * @ORM\Table(name="data_user")
 * @UniqueEntity(fields="email", message="This email is already used")
 */
class DataUser
{
    /**
     * @ORM\Column(name="id", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="id_role", type="integer")
     */
    private $idRole;

    /**
     * @ORM\Column(name="last_name",type="string", length = 128)
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @ORM\Column(name="first_name", type="string", length = 128)
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @Assert\Length(max=64)
     */
    private $plainPassword;

    /**
     * @ORM\Column(name="password",type="string", length=4096)
     */
    private $password;

    /**
     * @ORM\Column(name="email",type="string", length = 128, unique=true)
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @ORM\Column(name="subscription_email", type="boolean");
     */
    private $subscriptionEmail = true;

    /**
     * @ORM\Column(name="enabled", type="boolean");
     */
    private $enabled = false;

    public $userName;

    /*public function __construct(
        string $lastName,
        string $firstName,
        string $plainPassword,
        string $password,
        string $email,
        $roles = ['ROLE_USER'],
        bool $subscriptionEmail = true,
        bool $enabled = false
    )
    {

    }*/

    public function getId()
    {
        return $this->id;
    }

    public function getIdRole()
    {
        return $this->idRole;
    }

    public function setIdRole($idRole)
    {
        $this->idRole = $idRole;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getSubscriptionEmail()
    {
        return $this->subscriptionEmail;
    }

    public function setSubscriptionEmail(bool $subscriptionEmail = true)
    {
        $this->subscriptionEmail = $subscriptionEmail;
    }
}
