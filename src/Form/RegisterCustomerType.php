<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterCustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom',TextType::class,[
                'label'=> 'Votre prénom',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre prénom',
                    'class'=> 'form-control'
                ]

            ])
            ->add('nom',TextType::class,[
                'label'=> 'Votre nom',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre nom'
                ]
            ])
            ->add('email',EmailType::class,[
                'label'=> 'Votre email',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre email'
                ]
            ])
         /*  ->add('roles',TextType::class,[
               'label'=>"votre role",
               'attr'=>[
                   'value'=>"ROLE_CUSTOMER"
               ]
           ])
         */


            ->add('password',PasswordType::class,[
              'label'=> 'Votre mot de passe',
              'attr'=>[
                  'placeholder'=>'Merci de saisir votre mot de passe'
              ]
          ])
            ->add('adresse',TextType::class,[
                'label'=> 'Votre adresse',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre adresse'
                ]
            ])
            ->add('telephone',TextType::class,[
                'label'=> 'Votre numéro de téléphone',
                'attr'=>[
                    'placeholder'=>'Merci de saisir votre numéro de téléphone'
                ]
            ])
            ->add('etat',HiddenType::class,[
                'label'=>'etat',
                'attr'=>[
                    'value'=>"active"
                ]

            ])
           ->add('cni',TextType::class,[
               'label'=> "Votre Numéro d'identification national",
               'attr'=>[
                   'placeholder'=>"Votre Numéro d'identification national"
               ]
           ])
            ->add('submit',SubmitType::class,[
                'label'=>"S'inscrire"
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
