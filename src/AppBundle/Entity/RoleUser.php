<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="role_user")
 */
class RoleUser implements AdvancedUserInterface
{
    /**
     * @ORM\Column(name="id", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    private $roles = ['ROLE_USER'];

    private $username;

    private $password;

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        return $this->username = $username;
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        return $this->password = $password;
    }

    public function getRoles()
    {
        return [$this->roles];
    }

    public function setRoles(string $roles)
    {
        $this->roles = [$roles];
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

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        return null;
    }
}