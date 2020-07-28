<?php

namespace App\Form;

use App\Business\Article\ArticleCreationAction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleCreationType extends AbstractType
{


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add(
                'title',
                TextType::class,
                [
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'test',

                    ],
                    'help'  => "Le Titre de votre article"
                ]
            )
            ->add(
                'content',
                TextareaType::class,
                [
                    'required'  => false
                ]
            )
            ->add(
                'picture',
                UrlType::class,
                [
                    'required'  =>  false
                ]
            )
//            ->add(
//                'competences',
//                CollectionType::class
//            )
//            ->add(
//                'type',
//                EntityType::class,
//                [
//                    'class'=> Type::class,
//                    'choices' => $types,
//                ]
//            )
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => ArticleCreationAction::class
            ]
        );
    }
}