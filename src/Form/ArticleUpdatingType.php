<?php


namespace App\Form;


use App\Business\Article\ArticleUpdatingAction;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleUpdatingType extends AbstractType
{


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add(
//                'id',
//                HiddenType::class,
//                [
//                    'required'  => false
//                ]
//            )
            ->add(
                'title',
                TextType::class,
                [
                    'required'  => true
                ]
            )
            ->add(
                'content',
                TextareaType::class,
                [
                    'required'  => true
                ]
            )
            ->add(
                'picture',
                UrlType::class,
                [
                    'required'  => false
                ]
            )
            ->add(
                'tags',
                EntityType::class,
                [
                    'class' => Tag::class,
                    'choice_label' => 'name',
                    'multiple'      => true
                ]
            )
//            ->add(
//                'publicationDate',
//                HiddenType::class,
//                [
//                    'required'  => false
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
                'data_class' => ArticleUpdatingAction::class
            ]
        );
    }

}