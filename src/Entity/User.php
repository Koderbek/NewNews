<?php
/**
 * Created by PhpStorm.
 * User: Profsoft
 * Date: 26.09.2018
 * Time: 19:48
 */

namespace App\Entity;


use App\Helper\Status\StatusTrait;
use App\Helper\Status\UserStatus;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * @package App\Entity
 *
 * @ORM\Entity()
 * @UniqueEntity("login", message="Данный пользователь уже зарегистрирован")
 */
class User implements UserInterface
{
    use StatusTrait;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="login")
     * @Assert\NotBlank(message="Необходимо заполнить поле")
     */
    protected $login;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string")
     * @Assert\NotBlank(message="Необходимо заполнить поле")
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string")
     */
    protected $salt;

    /**
     * @var string
     * @ORM\Column(name="role", type="string")
     */
    protected $roles;

    /**
     * @var ArrayCollection|NewsCategory[]
     * @ORM\ManyToMany(targetEntity="NewsCategory")
     */
    protected $newsCategories;

    /**
     * @var DayInformation|null
     * @ORM\OneToOne(targetEntity="DayInformation", mappedBy="user")
     */
    protected $information;

    public function __construct()
    {
        $this->setStatus(UserStatus::ACTIVE);
        $this->setRoles('ROLE_USER');
        $this->newsCategories = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt(string $salt)
    {
        $this->salt = $salt;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @param string $roles
     */
    public function setRoles(string $roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return NewsCategory[]|ArrayCollection
     */
    public function getNewsCategories()
    {
        return $this->newsCategories;
    }

    /**
     * @param NewsCategory[]|ArrayCollection $newsCategories
     */
    public function setNewsCategories($newsCategories)
    {
        $this->newsCategories = $newsCategories;
    }

    /**
     * @return null|string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param null|string $city
     */
    public function setCity(?string $city)
    {
        $this->city = $city;
    }

    /**
     * @return DayInformation|null
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param DayInformation|null $information
     */
    public function setInformation(?DayInformation $information)
    {
        $this->information = $information;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->getLogin();
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function __toString()
    {
        return $this->getLogin();
    }
}
