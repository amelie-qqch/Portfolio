<?php


namespace App\Business\Article;

use Doctrine\Common\Collections\ArrayCollection;

class ArticleUpdatingAction
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
     * @var ArrayCollection
     */
    public $tags;

//    /**
//     * @param Tag $tag
//     * @return $this
//     */
//    public function removeTag(Tag $tag): self
//    {
//        if ($this->tags->contains($tag)) {
//            $this->tags->removeElement($tag);
//            $tag->removeArticle($this);
//        }
//
//        return $this;
//    }

    /**
     * @param $article
     * @return ArticleUpdatingAction
     */
    public static function update($article)
    {
        $action = new self();

        $action->title           = $article->getTitle();
        $action->content         = $article->getContent();
        $action->picture         = $article->getContent();
        $action->tags            = $article->getTags();

        return $action;
    }



}