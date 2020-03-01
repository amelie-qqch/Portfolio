<?php

namespace App\Form;

use App\Business\ArticleCreationAction;
use App\Entity\Type;
use App\Repository\TypeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleCreationType extends AbstractType
{
    /**
     * @var TypeRepository
     */
    private $typeRepository;

    /**
     * @param TypeRepository $typeRepository
     */
    public function __construct(TypeRepository $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $types = $this->typeRepository->enumerate();

        $builder
            ->add(
                'titre',
                TextType::class,
                [
                    'required' => true
                ]
            )
//            ->add(
//                'competences',
//                CollectionType::class
//            )
            ->add(
                'type',
                EntityType::class,
                [
                    'class'=> Type::class,
                    'choices' => $types,
                ]
            )
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleCreationAction::class
        ]);
    }
}