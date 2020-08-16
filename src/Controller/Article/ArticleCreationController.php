<?php

namespace App\Controller\Article;

use App\Business\Article\ArticleCreationAction;
use App\Business\Article\ArticleCreationHandler;
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

	
	//IMPORTANT Séparation de la route recevant le formulaire soumit (celle avec request) et la route qui affiche le formulaire vide pour le remplir (purposeCreation)

    /**
     * @return Response
     */
    public function purposeCreation(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY','Access denied','Vous devez posséder un compte pour accéder à cette fonctionnalité.');
        
        $action = new ArticleCreationAction();

        // Préhydratation
//        $action->title = 'Un titre par défaut';
//        $action->picture="http://placehold.it/350x350";
//        $action->content="du text";
		
		//passer l'action au formulaire va permettre d'associer le formulaire aux propriétés de l'action automatiquement
        // au moment du submit (donc dans l'autre fonction ... mais du coup on le passe maintenant parce que ?)
        $form = $this->createArticleCreationType($action);

        return $this->render(
            'article/article_creation.html.twig',
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
        $action         = new ArticleCreationAction();
        $action->author = $this->getUser();
        $form           = $this->createArticleCreationType($action);

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
        $this->handler->handle($action);

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
            ->add('creer', SubmitType::class)
        ;

        return $form;
    }
}