<?php

namespace App\Controller\Article;

use App\Business\ArticleCreationAction;
use App\Business\ArticleCreationHandler;
use App\Form\ArticleCreationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleCreationController extends AbstractController
{
    /**
     * @var ArticleCreationHandler
     */
    private $handler;

    /**
     * @param ArticleCreationHandler $handler
     */
    public function __construct(ArticleCreationHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return Response
     */
    public function purposeCreation(): Response
    {
        $action = new ArticleCreationAction();

        // Préhydratation
        $action->titre = 'Un titre par défaut';

        $form = $this->createArticleCreationType($action);

        return $this->render(
            'pages/article_creation.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function creation(Request $request): Response
    {
        $action = new ArticleCreationAction();
        $form   = $this->createArticleCreationType($action);

        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {

            $this->addFlash('error', 'Erreur lors de la création de votre article.');

            return $this->render(
                'pages/article_creation.html.twig',
                [
                    'form' => $form->createView()
                ]
            );
        }

        // Success
        $article = $this->handler->handle($action);

        $this->addFlash('success', 'Votre article a été créé avec succès.');

        return $this->redirectToRoute('articles_creation_purpose');
    }

    /**
     * @param ArticleCreationAction $action
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createArticleCreationType(ArticleCreationAction $action)
    {
        $form = $this->createForm(
            ArticleCreationType::class,
            $action,
            [
                'method' => 'POST',
                'action' => $this->generateUrl('articles_creation')
            ]
        );

        $form
            ->add('submit', SubmitType::class)
        ;

        return $form;
    }
}