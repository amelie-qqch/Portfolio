<?php

namespace App\Business\Article;

use App\Entity\Article;
use App\Repository\ArticleRepository;

class ArticleCreationHandler
{
    /**
     * @var ArticleRepository
     */
    private $repository;


    /**
     * ArticleCreationHandler constructor.
     * @param ArticleRepository $repository
     */
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Crée un article.
     *
     * @param ArticleCreationAction $action
     * @return Article
     */
    public function handle(ArticleCreationAction $action): Article
    {
		//Entité chargé avec les données du DTO grâce à fonction create
        //$action->tags   = $action->addTag($action->tag);
        $article        = new Article($action->title, $action->content, $action->picture, $action->author, $action->tags);

		//Fait persister en bdd
        $this->repository->create($article);

        return $article;
    }
}