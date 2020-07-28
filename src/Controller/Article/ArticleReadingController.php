<?php

namespace App\Controller\Article;

use App\Business\Article\ArticleReadingAction;
use App\Business\Article\ArticleReadingHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleReadingController extends AbstractController
{
    /**
     * @var ArticleReadingHandler
     */
    private $handler;

    /**
     * @param $handler
     */
    public function __construct(ArticleReadingHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param int $id
     * @return Response
     */
    public function read(int $id): Response
    {
        // Création d'une action.
        $action = ArticleReadingAction::read($id);
        // Passage de l'action à un handler.
        $article = $this->handler->handle($action);

        return $this->render
        (
            'article/article.html.twig',
            [
                'article'   =>  $article
            ]
        );
    }
}