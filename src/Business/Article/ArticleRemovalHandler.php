<?php


namespace App\Business\Article;

use App\Repository\ArticleRepository;

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
        //vérifier que l'article à des tags
        if(!$article->getTags()->isEmpty())
        {
            // pour chaque tag enlever l'article de sa collection
            $tags = $article->getTags();
            foreach ($tags as $tag) {
                $tag->removeArticle($article);
            }
            $article->getTags()->clear();

            //Enlever l'article de la collection d'article de tag ?

        }
        $this->repository->delete($article);

    }

}