<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var string|null
     *
     * @ORM\Column(name="picture", type="text", length=65535, nullable=true)
     */
    private $picture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publicationDate", type="datetime", nullable=false)
     */
    private $publicationDate;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string|null
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @return \DateTime
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Article constructor.
     * @param $title
     * @param $content
     * @param $picture
     */
    public function __construct($title, $content, $picture)
    {
        $this->title   = $title;
        $this->content = $content;
        $this->picture = $picture;

        $this->publicationDate = new \DateTime();
    }

//    public function update($action)
//    {
//        $article = new self();
//
//        $article->id              = $action->id;
//        $article->title           = $action->title;
//        $article->content         = $action->content;
//        $article->picture         = $action->picture;
//
//        return $article;
//    }

    /**
     * @param $title
     */
    public function changeTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param $content
     */
    public function changeContent($content)
    {
        $this->content = $content;
    }

    /**
     * @param $picture
     */
    public function changePicture($picture)
    {
        $this->picture = $picture;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

}
