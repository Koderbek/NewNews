<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 08.05.2019
 * Time: 16:16
 */

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DayInformation
 * @package App\Entity
 *
 * @ORM\Entity()
 */
class DayInformation
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    protected $usd;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    protected $eur;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    protected $weather;

    /**
     * @var User|null
     * @ORM\OneToOne(targetEntity="User", inversedBy="information")
     */
    protected $user;

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
     * @return null|string
     */
    public function getUsd()
    {
        return $this->usd;
    }

    /**
     * @param null|string $usd
     */
    public function setUsd(?string $usd)
    {
        $this->usd = $usd;
    }

    /**
     * @return null|string
     */
    public function getEur()
    {
        return $this->eur;
    }

    /**
     * @param null|string $eur
     */
    public function setEur(?string $eur)
    {
        $this->eur = $eur;
    }

    /**
     * @return null|string
     */
    public function getWeather()
    {
        return $this->weather;
    }

    /**
     * @param null|string $weather
     */
    public function setWeather(?string $weather)
    {
        $this->weather = $weather;
    }

    /**
     * @return User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     */
    public function setUser(?User $user)
    {
        $this->user = $user;
    }
}