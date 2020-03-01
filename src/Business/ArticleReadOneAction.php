<?php

namespace App\Business;


use App\Entity\Article;
use App\Repository\ArticleRepository;

class ArticleReadOneAction
{
    /**
     * @var Article
     */
    private $article;
    public $titre;

    /**
     * @param $id
     * @param ArticleRepository $repo
     * @return ArticleReadOneAction
     */
    public static function read($id, ArticleRepository $repo){
        $action = new self();
        $article = $repo->findOneBy($id);
        $action->titre = $article->titre;
        return $action;
    }


}
