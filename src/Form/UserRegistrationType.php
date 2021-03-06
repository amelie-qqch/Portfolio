<?php


namespace App\Form;


use App\Business\User\UserRegistrationAction;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegistrationType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'username',
                TextType::class,
                [
                    'required'  => true,
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'required'  => true,
                ]
            )
            ->add(
                'password',
                PasswordType::class,
                [
                    'required' => true,
                ]
            )
            ->add(
                'passwordConfirmation',
                PasswordType::class,
                [
                    'required' => true,
                ]
            );

    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => UserRegistrationAction::class
            ]
        );
    }

}