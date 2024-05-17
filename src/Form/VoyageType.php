<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Pays;
use App\Entity\User;
use App\Entity\Voyage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('destination', TextType::class, [
                'attr' => [
                    'class' => 'w-full rounded-md border border-gray-300 bg-white py-2 px-4 text-base font-medium text-black outline-none focus:border-yellow-500 focus:shadow-md'
                ]
            ])
            ->add('dateDepart', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'w-full rounded-md border border-gray-300 bg-white py-2 px-4 text-base font-medium text-black outline-none focus:border-yellow-500 focus:shadow-md'
                ]
            ])
            ->add('dateRetour', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'w-full rounded-md border border-gray-300 bg-white py-2 px-4 text-base font-medium text-black outline-none focus:border-yellow-500 focus:shadow-md'
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'w-full rounded-md border border-gray-300 bg-white py-2 px-4 text-base font-medium text-black outline-none focus:border-yellow-500 focus:shadow-md'
                ]
            ])
            ->add('image', TextType::class, [
                'attr' => [
                    'class' => 'w-full rounded-md border border-gray-300 bg-white py-2 px-4 text-base font-medium text-black outline-none focus:border-yellow-500 focus:shadow-md'
                ]
            ])
            ->add('prix', TextType::class, [
                'attr' => [
                    'class' => 'w-full rounded-md border border-gray-300 bg-white py-2 px-4 text-base font-medium text-black outline-none focus:border-yellow-500 focus:shadow-md'
                ]
            ])
            ->add('pays', EntityType::class, [
                'class' => Pays::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => false,
                'attr' => [
                    'class' => 'w-full rounded-md border border-gray-300 bg-white py-2 px-4 text-base font-medium text-black outline-none focus:border-yellow-500 focus:shadow-md'
                ]
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'w-full rounded-md border border-gray-300 bg-white py-2 px-4 space-x-2 text-base font-medium text-black outline-none focus:border-yellow-500 focus:shadow-md'
                ]
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
        ]);
    }
}
