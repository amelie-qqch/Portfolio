<?php


namespace App\Business\Article;


use App\Repository\ArticleRepository;
use http\Env\Response;

class ArticleRemovalHandler
{
    /**
     * @var ArticleRepository
     */
    private $repository;

    /**
     * ArticleRemovalHandler constructor.
     * @param ArticleRepository $repository
     */
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ArticleRemovalAction $action
     * @throws \Doctrine\Common\Persistence\Mapping\MappingException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(ArticleRemovalAction $action)
    {
        $article = $this->repository->findOneBy(['id'=>$action->id]);

        $this->repository->delete($article);

    }

}