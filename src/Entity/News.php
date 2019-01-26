<?php
/**
 * Created by PhpStorm.
 * User: ЮРИЙ
 * Date: 20.01.2019
 * Time: 17:46
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class News
 * @package App\Entity
 *
 * @ORM\Entity()
 */
class News
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
    protected $title;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=600, nullable=true)
     */
    protected $news;

    /**
     * @var NewsCategory|null
     * @ORM\ManyToOne(targetEntity="NewsCategory", inversedBy="news")
     */
    protected $category;

    /**
     * @return int
     */
    public function getId(): int
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
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     */
    public function setTitle(?string $title)
    {
        $this->title = $title;
    }

    /**
     * @return null|string
     */
    public function getNews(): ?string
    {
        return $this->news;
    }

    /**
     * @param null|string $news
     */
    public function setNews(?string $news)
    {
        $this->news = $news;
    }

    /**
     * @return NewsCategory|null
     */
    public function getCategory(): ?NewsCategory
    {
        return $this->category;
    }

    /**
     * @param NewsCategory|null $category
     */
    public function setCategory(?NewsCategory $category)
    {
        $this->category = $category;
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}