<?php


namespace App\Business\Article;


use App\Entity\Article;
use App\Repository\ArticleRepository;

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
     * @param $article
     * @return ArticleUpdatingAction
     */
    public static function update($article)
    {
        $action = new self();

        $action->title           = $article->getTitle();
        $action->content         = $article->getContent();
        $action->picture         = $article->getContent();

        return $action;
    }



}