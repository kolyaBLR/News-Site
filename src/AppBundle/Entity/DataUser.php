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
 */
class DataUser implements AdvancedUserInterface
{
    /**
     * @ORM\Column(name="id", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * @Assert\NotBlank()
     */
    private $plainPassword;

    /**
     * @ORM\Column(name="password",type="string", length=4096)
     */
    private $password;

    /**
     * @ORM\Column(name="email",type="string", length = 128, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="access_level", type="string", length = 32);
     * @Assert\NotBlank()
     */
    private $roles = 'ROLE_USER';

    /**
     * @ORM\Column(name="subscription_email", type="boolean");
     */
    private $subscriptionEmail = true;

    /**
     * @ORM\Column(name="enabled", type="boolean");
     */
    private $enabled = false;

    public $userName;

    public function __construct(
        string $lastName = '1',
        string $firstName = '1',
        string $plainPassword = '1',
        string $email = '',
        $roles = ['ROLE_USER'],
        bool $subscriptionEmail = true,
        bool $enabled = false
    )
    {
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->plainPassword = $plainPassword;
        $this->email = $email;
        $this->roles = $roles;
        $this->subscriptionEmail = $subscriptionEmail;
        $this->enabled = $enabled;
    }

    public function getId()
    {
        return $this->id;
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

    public function getUsername()
    {
        return $this->email;
    }

    public function getRoles()
    {
        return [$this->roles];
    }

    public function setRoles($roles)
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

    public function getSubscriptionEmail()
    {
        return $this->subscriptionEmail;
    }

    public function setSubscriptionEmail(bool $subscriptionEmail = true)
    {
        $this->subscriptionEmail = $subscriptionEmail;
    }

    public function isAccountNonExpired()
    {
        return $this->enabled;
    }

    public function isAccountNonLocked()
    {
        return $this->enabled;
    }

    public function isCredentialsNonExpired()
    {
        return $this->enabled;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled)
    {
        $this->enabled = $enabled;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }
}
