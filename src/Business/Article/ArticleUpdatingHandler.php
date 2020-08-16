<?php


namespace App\Business\Article;


use App\Entity\Article;
use App\Repository\ArticleRepository;

class ArticleUpdatingHandler
{
    /**
     * @var ArticleRepository
     */
    private $repository;

    /**
     * ArticleUpdatingHandler constructor.
     * @param ArticleRepository $repository
     */
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ArticleUpdatingAction $action
     * @return Article
     */
    public function handle(ArticleUpdatingAction $action):Article
    {
        $article = $this->repository->findOneBy(['id' => $action->id]);

        $article->changeTitle($action->title);
        $article->changeContent($action->content);
        $article->changePicture($action->picture);
        //vide la liste de tag pour pouvoir les remplacer par les nouveaux
        $article->getTags()->clear();
        foreach ($action->tags as $tag)
        {
            $article->addTag($tag);
        }


        $this->repository->update($article);

        return $article;
    }
}