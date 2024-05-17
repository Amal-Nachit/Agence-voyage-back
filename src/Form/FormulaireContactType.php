<?php

namespace App\Form;

use App\Entity\FormulaireContact;
use App\Entity\Statut;
use App\Entity\User;
use App\Entity\Voyage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormulaireContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbPlaces')
            ->add(
                'message',
                TextareaType::class,
                ['attr' => [
                        'class' => 'w-full rounded-md border border-gray-300 bg-white py-2 px-4 text-base font-medium text-black outline-none focus:border-yellow-500 focus:shadow-md'
                    ]
                ]
            )
            ->add('voyage', EntityType::class, [
                'class' => Voyage::class,
                'choice_label' => 'destination',
            ])
            ->add('email', EmailType::class, [
                // 'class' => User::class,
                'mapped' => false,
                'empty_data' => 'email',
                'required' => true,
                'label' => "Email :"
            ])

            ->add('voyage', EntityType::class, [
                'class' => Voyage::class,
                'choice_label' => 'id',
                'multiple' => true,
                'expanded' => false,
                'attr' => [
                    'class' => 'w-full rounded-md border border-gray-300 bg-white py-2 px-4 text-base font-medium text-black outline-none focus:border-yellow-500 focus:shadow-md'
                ]
            ])
            ->add('statut', TextType::class, [
                'class' => Statut::class,
                'mapped' => false,
                'empty_data' => 'statut',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormulaireContact::class,
        ]);
    }
}
