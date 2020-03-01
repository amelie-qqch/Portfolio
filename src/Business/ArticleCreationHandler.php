<?php

namespace App\Business;

use App\Entity\Article;
use App\Repository\ArticleRepository;

class ArticleCreationHandler
{
    /**
     * @var ArticleRepository
     */
    private $repository;

    /**
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
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(ArticleCreationAction $action): Article
    {
        $article = Article::create($action->titre, $action->type);

        $this->repository->create($article);

        return $article;
    }
}