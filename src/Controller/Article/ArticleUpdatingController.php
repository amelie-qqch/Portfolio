<?php


namespace App\Controller\Article;


use App\Business\Article\ArticleReadingAction;
use App\Business\Article\ArticleReadingHandler;
use App\Business\Article\ArticleUpdatingAction;
use App\Business\Article\ArticleUpdatingHandler;
use App\Form\ArticleUpdatingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleUpdatingController extends AbstractController
{
    /**
     * @var ArticleUpdatingHandler
     */
    private $updatingHandler;

    /**
     * @var ArticleReadingHandler
     */
    private $readingHandler;

    /**
     * ArticleUpdatingController constructor.
     * @param ArticleUpdatingHandler $handler
     * @param ArticleReadingHandler $readingHandler
     */
    public function __construct(ArticleUpdatingHandler $handler, ArticleReadingHandler $readingHandler)
    {
        $this->updatingHandler = $handler;
        $this->readingHandler = $readingHandler;
    }

    /**
     * @param int $id
     * @return Response
     */
    public function purposeUpdate(int $id):Response
    {
        $readAction = new ArticleReadingAction();
        $readAction = $readAction::read($id);
        $article = $this->readingHandler->handle($readAction);

        $updateAction = new ArticleUpdatingAction();

        //préhydratation Est-ce que j'ai besoin de faire ça si je passe directement l'article récupéré au formulaire???????? -> FONCTIONNE PAS REVOIR LA PARTIE AVANT
        $updateAction->id              = $article->getId();
        $updateAction->title           = $article->getTitle();
        $updateAction->content         = $article->getContent();
        $updateAction->picture         = $article->getPicture();
        $updateAction->tags            = $article->getTags();

        $form = $this->createArticleUpdatingType($updateAction, $id);

        return $this->render(
            'article/article_creation.html.twig',
            [
                'form'      => $form->createView(),
                'oldTags'   => $article->getTags()
            ]
        );
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function update(int $id, Request $request):Response
    {
        $action = new ArticleUpdatingAction();
        $action->id = $id;

        $form = $this->createArticleUpdatingType($action, $id);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {

            $this->addFlash('error', 'Erreur lors de la création de votre article.');

            return $this->render(
                'article/article_creation.html.twig',
                [
                    'form' => $form->createView()
                ]
            );
        }

        // Success
        $this->updatingHandler->handle($action);

        $this->addFlash('success', 'Votre article a été modifié avec succès.');

        return $this->redirectToRoute('home');

    }

    /**
     * @param ArticleUpdatingAction $action
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createArticleUpdatingType(ArticleUpdatingAction $action, $id)
    {
        $form = $this->createForm(
            ArticleUpdatingType::class,
            $action,
            [
                'method' => 'POST',
                'action' => $this->generateUrl('articles_update', ['id' => $id])
            ]
        );

        $form->add('modifier', SubmitType::class);

        return $form;
    }
}