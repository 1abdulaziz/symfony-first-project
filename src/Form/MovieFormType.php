<?php

namespace App\Form;

use App\Entity\Movie;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'required' => false,

                'attr' => [
                    'placeholder' => 'Enter movie title',
                    'class' => 'bg-transparent block border-b-2 h-20 w-full text-2xl outline-none',

                ]
            ])
            ->add('releaseYear', IntegerType::class, [
                'label' => false,
                'required' => false,

                'attr' => [
                    'placeholder' => 'Enter movie release year',
                    'class' => 'bg-transparent block border-b-2 h-20 w-full text-2xl outline-none',

                ]
            ])
            ->add('description', TextareaType::class,[
                'label' => false,
                'required' => false,

                'attr' => [
                    'placeholder' => 'Enter movie description',
                    'class' => 'bg-transparent block border-b-2 h-20 w-full text-2xl outline-none',
                ]
            ])
            ->add('imagePath', FileType::class,[
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Enter movie image path',
                    'class' => 'py-20',
                ]
            ])
//            ->add('actors')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
