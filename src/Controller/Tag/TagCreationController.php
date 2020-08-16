<?php


namespace App\Controller\Tag;


use App\Business\Tag\TagCreationAction;
use App\Business\Tag\TagCreationHandler;
use App\Form\TagCreationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TagCreationController extends AbstractController
{
    /**
     * @var TagCreationHandler
     */
    private $handler;

    /**
     * TagCreationController constructor.
     * @param TagCreationHandler $handler
     */
    public function __construct(TagCreationHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return Response
     */
    public function purposeCreation(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $action = new TagCreationAction();
        $form   = $this->createTagCreationType($action);

        return $this->render(
            'tag/tag_creation.html.twig',
            [
                'form' => $form->createView()
            ]
        );

    }

    /**
     * @param Request $request
     * @return Response
     */
    public function creation(Request $request):Response
    {
        $action = new TagCreationAction();
        $form   = $this->createTagCreationType($action);

        $form->handleRequest($request);
        if(!$form->isSubmitted() || !$form->isValid())
        {
            $this->addFlash('error', 'Erreur lors de la création du tag.');
            return $this->render(
                'tag/tag_creation.html.twig',
                [
                    'form'=> $form->createView()
                ]
            );
        }

        $this->handler->handle($action);
        $this->addFlash('success', 'Votre tag a bien été créé.');

        return $this->redirectToRoute('tags_creation_purpose');

    }

    private function createTagCreationType(TagCreationAction $action)
    {
        $form = $this->createForm(
            TagCreationType::class,
            $action,
            [
                'method'   => 'POST',
                'action'    => $this->generateUrl('tags_creation')
            ]
        );

        $form
            ->add('creer', SubmitType::class)
        ;

        return $form;
    }
}