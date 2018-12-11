<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * TUser
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * 
     * PROPERTIES
     * 
     */

     /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     */
    private $username;

    /**
     * @var string
     * 
     * @ORM\Column(name="firstname", type="string", length=50, nullable=false)
     */
     private $firstname;

    /**
     * @var string
     * 
     * @ORM\Column(name="lastname", type="string", length=50, nullable=false)
     */
    private $lastname;

     /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
     private $password;

     /**
     * @var string
     *
     */
    private $plainpassword;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=50, nullable=false)
     */
    private $phone;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array", length=0, nullable=false)
     */
    private $roles = [];

    // /**
    //  * @var \DateTime
    //  *
    //  * @ORM\Column(name="createddate", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
    //  */
    // private $createddate;



    public function __construct() {}

    /**
     * 
     * METHODS
     * 
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainpassword;
    }

    public function setPlainPassword(string $plainpassword): self
    {
        $this->plainpassword = $plainpassword;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    // public function getCreateddate(): ?\DateTimeInterface
    // {
    //     return $this->createddate;
    // }

    // public function setCreateddate(\DateTimeInterface $createddate): self
    // {
    //     $this->createddate = $createddate;
    //     return $this;
    // }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function eraseCredentials() {}

    public function getSalt() {
        return null;
    }

}