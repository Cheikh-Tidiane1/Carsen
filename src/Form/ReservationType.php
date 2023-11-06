<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Mode_de_Livraison',ChoiceType::class,[
                'choices'=>[
                    'Retrait en agence'=>"Retrait en agence",
                    'Livraison à votre adresse'=>"Livraison à votre adresse",
                ],
                'multiple'=>false,
                'expanded'=>true
            ])

            ->add('Mode_de_Paiement',ChoiceType::class,[
                'choices'=>[
                    'Paiement à la livraison'=>"Paiement à la livraison",
                    'En Ligne'=>"En ligne",
                ],
                'multiple'=>false,
                'expanded'=>true
            ])

            ->add('submit',SubmitType::class,[
                'label' => 'Valider ma réservation',
                'attr' => [
                    'class' => 'btn btn-success btn-block'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
