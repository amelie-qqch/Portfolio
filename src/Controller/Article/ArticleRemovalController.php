<?php


namespace App\Controller\Article;


use App\Business\Article\ArticleRemovalAction;
use App\Business\Article\ArticleRemovalHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleRemovalController extends AbstractController
{
    /**
     * @var ArticleRemovalHandler
     */
    private $handler;

    /**
     * ArticleRemovalController constructor.
     * @param ArticleRemovalHandler $handler
     */
    public function __construct(ArticleRemovalHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @param int $id
     * @return Response
     */
    public function removal(int $id): Response
    {
//       if (!$this->isGranted(['ROLE_ADMIN'])){
//           throw new NotFoundHttpException();
//       }


        $action = new ArticleRemovalAction();
        $action = $action::delete($id);
        $this->handler->handle($action);
        return $this->redirectToRoute('home');
    }
}