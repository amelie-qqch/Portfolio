<?php


namespace App\Business\Article;

//En bout de chaine n'est dépendant de rien
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

class ArticleCreationAction
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $picture;

    /**
     * @var User
     */
    public $author;

    /**
     * @var ArrayCollection
     */
    public $tags;
//
//    /**
//     * @param Tag $tag
//     * @return ArticleCreationAction
//     */
//    public function addTag(Tag $tag): self
//    {
//        if (!$this->tags->contains($tag)) {
//            $this->tags[] = $tag;
//            $tag->addArticle($this);
//        }
//
//        return $this;
//    }


    /**
     * @param $article
     * @return ArticleCreationAction
     */
//    public static function create($article)
//    {
//        $action = new self();
//
//        $action->title      = $article->title;
//        $action->content    = $article->content;
//        $action->picture    = $article->picture;
//
//        return $action;
//    }

}