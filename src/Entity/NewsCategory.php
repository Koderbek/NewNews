<?php
/**
 * Created by PhpStorm.
 * User: ЮРИЙ
 * Date: 12.01.2019
 * Time: 21:24
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class NewsCategory
 * @package App\Entity
 *
 * @ORM\Entity()
 */
class NewsCategory
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Заполните поле")
     */
    protected $name;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Заполните поле")
     */
    protected $englishName;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getEnglishName(): ?string
    {
        return $this->englishName;
    }

    /**
     * @param null|string $englishName
     */
    public function setEnglishName(?string $englishName): void
    {
        $this->englishName = $englishName;
    }

    public function __toString()
    {
        return $this->getName();
    }
}