<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * User
 * @UniqueEntity(fields="email", message="Ovaj email je zauzet bre!")
 * @UniqueEntity(fields="username", message="Ovo korisnicko ime je zauzeto!")
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="username", type="string", length=100, unique=true)
     */
    private $username;
    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;
    
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     * @var type 
     */
    private $plainPassword;
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     */
    private $email;
    /**
     * @var bool
     * 
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    
    public function __construct() {
        $this->isActive = true;
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * 
     * @param type $plainPassword
     */
    public function setPlainPassword($plainPassword) 
    {
        $this->plainPassword = $plainPassword;
    }
    
    /**
     * 
     * @return type
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }
    /**
     * Get isActive
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    
    public function eraseCredentials() {
        
    }
    
    public function getRoles() {
        return ['ROLE_USER'];
    }
    
    public function getSalt() {
        return null;
    }
    
    public function serialize() {
        return serialize([
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password
        ]);
    }
    
    public function unserialize($serialized) {
        list(
            $this->id,
            $this->username,
            $this->password
        ) = unserialize($serialized);
    }
}
