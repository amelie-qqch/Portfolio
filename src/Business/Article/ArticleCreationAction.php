<?php


namespace App\Business\Article;

//En bout de chaine n'est dépendant de rien
class ArticleCreationAction
{
    public $title;
    public $content;
    public $picture;

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