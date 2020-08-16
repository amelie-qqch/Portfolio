<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
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
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="articles")
     */
    private $tags;


    /**
     * @return User|null
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * Article constructor.
     * @param $title
     * @param $content
     * @param $picture
     * @param $author
     * @param $tags
     */
    public function __construct($title, $content, $picture, $author, $tags)
    {
        $this->title   = $title;
        $this->content = $content;
        $this->picture = $picture;
        $this->author  = $author;
        $this->tags    = $tags;

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


    /**
     * @param User|null $author
     * @return $this
     */
    public function changeAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }


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
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @param Tag $tag
     * @return $this
     */
    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addArticle($this);
        }

        return $this;
    }

    /**
     * @param Tag $tag
     * @return $this
     */
    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            $tag->removeArticle($this);
        }

        return $this;
    }



}
