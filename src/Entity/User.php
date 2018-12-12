<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * TUser
 *
 * @ORM\Table(name="user")
 * @UniqueEntity(fields="username")
 * @UniqueEntity(fields="email")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
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
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max=50)
     */
    private $username;

    /**
     * @var string
     * 
     * @ORM\Column(name="firstname", type="string", length=50, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max=50)
     */
     private $firstname;

    /**
     * @var string
     * 
     * @ORM\Column(name="lastname", type="string", length=50, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max=50)
     */
    private $lastname;

     /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     * @Assert\Length(max=255)
     */
     private $password;

     /**
     * @var string
     * 
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private $plainpassword;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Assert\Length(max=50)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=50, nullable=true)
     * @Assert\Length(max=50)
     */
    private $phone;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array", nullable=false)
     */
    private $roles = [];

    // /**
    //  * @var \DateTime
    //  *
    //  * @ORM\Column(name="createddate", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
    //  */
    // private $createddate;



    public function __construct() {
        $this->isActive = true;
    }

    /**
     * 
     * METHODS
     * 
     */
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername( string $username ): self
    {
        $this->username = $username;
        return $this;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname( string $firstname ): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname( string $lastname ): self
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword( string $password ): self
    {
        $this->password = $password;
        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainpassword;
    }

    public function setPlainPassword( string $plainpassword ): self
    {
        $this->plainpassword = $plainpassword;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail( string $email ): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone( string $phone ): self
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

    public function getRoles()
    {
        if (empty($this->roles)) {
            return ['ROLE_BUYER'];
        }
        return $this->roles;
    }

    public function setRoles( array $roles ): self
    {
        $this->roles = $roles;
        return $this;
    }

    function getIsActive()
    {
        return $this->isActive;
    }

    function setIsActive($isActive): self
    {
        $this->isActive = $isActive;
    }

    function addRole( $role )
    {
        $this->roles[] = $role;
    }

    public function eraseCredentials() {}

    public function getSalt() {
        return null;
    }

    /** @see \Serializable::serialize() */
    public function serialize() {
        return base64_encode(serialize(array(
            $this->id,
            $this->username,
            $this->lastname,
            $this->firstname,
            $this->email,
            $this->phone,
            $this->password,
            $this->roles,
            $this->isActive,
                // see section on salt below
                // $this->salt,
        )));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized) {
        list (
            $this->id,
            $this->username,
            $this->lastname,
            $this->firstname,
            $this->email,
            $this->phone,
            $this->password,
            $this->roles,
            $this->isActive,
                // see section on salt below
                // $this->salt
                ) = unserialize(base64_decode($serialized), ['allowed_classes' => false]);
    }

}