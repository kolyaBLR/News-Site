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
class DataUser implements AdvancedUserInterface
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
     *
     * @Assert\Length(max=64)
     */
    private $plainPassword;
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    public function setPlainPassword(string $plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }
    /**
     * @ORM\Column(name="password",type="string", length=4096)
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


    public $userName;

    public function getUsername()
    {
        return $this->email;
    }
    /**
     * @ORM\Column(name="access_level", type="string", length = 32);
     */
    private $roles = ['ROLE_USER'];
    public function getRoles()
    {
        return [$this->roles];
    }
    public function setRoles($roles)
    {
        $this->roles = [$roles];
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
    private $subscriptionEmail = true;
    public function getSubscriptionEmail()
    {
        return $this->subscriptionEmail;
    }
    public function setSubscriptionEmail($subscriptionEmail = true)
    {
        $this->subscriptionEmail = $subscriptionEmail;
    }

    /**
     * @ORM\Column(name="enabled", type="boolean");
     */
    private $enabled = false;

    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return bool true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired()
    {
        return $this->enabled;
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return bool true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked()
    {
        return $this->enabled;
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return bool true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired()
    {
        return $this->enabled;
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return DataUser
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}
