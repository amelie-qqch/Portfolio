<?php


namespace App\Controller;


use App\Business\User\Exceptions\UserAlreadyExistException;
use App\Business\User\UserExistVerificationHandler;
use App\Business\User\UserRegistrationAction;
use App\Business\User\UserRegistrationHandler;
use App\Form\UserRegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends AbstractController
{
    /**
     * @var UserRegistrationHandler
     */
    private $registrationHandler;

    /**
     * @var UserExistVerificationHandler
     */
    private $userVerificationHandler;


    /**
     * RegistrationController constructor.
     * @param UserRegistrationHandler $handler
     */
    public function __construct(UserRegistrationHandler $registrationHandler, UserExistVerificationHandler $userVerificationHandler)
    {
        $this->registrationHandler      = $registrationHandler;
        $this->userVerificationHandler  = $userVerificationHandler;
    }

    /**
     * @return Response
     */
    public function purposeRegistration(): Response
    {
        $action = new UserRegistrationAction();

        $form = $this->createUserRegistrationType($action);

        return $this->render(
            'user/user_registration.html.twig',
            [
                'form'  => $form->createView()
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function registration(Request $request): Response
    {
        // est-ce que j'ai besoin de recréer le formulaire si j'envoi l'utilisateur directement sur une autre page ?
        $action = new UserRegistrationAction();

        $form = $this->createUserRegistrationType($action);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            try {
                $this->registrationHandler->handle($action);

                $this->addFlash('success', 'Votre inscription a bien été prise en compte.');

                return $this->redirectToRoute('home');
            } catch (UserAlreadyExistException $exp) {
                $this->addFlash('error', 'Vous avez déjà un compte.');
            }
        } else {
            $this->addFlash('error', 'Erreur lors de votre inscription.');
        }

        return $this->render(
            'user/user_registration.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }


    /**
     * @param UserRegistrationAction $action
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createUserRegistrationType(UserRegistrationAction $action)
    {
        $form = $this->createForm(
            UserRegistrationType::class,
            $action,
            [
                'method'    => 'POST',
                'action'    => $this->generateUrl('registration')
            ]
        );

        $form->add('Inscription', SubmitType::class);

        return $form;
    }

}