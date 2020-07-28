<?php

namespace App\Business\Article;

use App\Repository\ArticleRepository;

class ArticleReadingHandler
{
    /**
     * @var ArticleRepository
     */
    private $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(ArticleReadingAction $action)
    {
        // Injecter le repository
        // Récupérer l'article par l'$id et le retourner
        $article = $this->repository->findOneBy(['id'=>$action->id]);
        // algo

        return $article;
    }
}