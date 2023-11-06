<?php

namespace App\Form;

use App\Entity\DemandeVente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class DemandeVenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeVoiture',ChoiceType::class,[
                'choices'=>[
                    'Berline'=>"Berline",
                    'Suv'=>"Suv",
                    '4x4'=>"4x4",
                    'Bus'=>"Bus",
                    'Minibus'=>"Minibus",
                    'Pick_up'=>"Pick_up"
                ]
            ])
            ->add('marque',ChoiceType::class,[
                'choices'=>[
                    'Toyata'=>"Toyata",
                    'Ford'=>"Ford",
                    'Renault'=>"Renault",
                    'Bmw'=>"Bmw",
                    'Nissan'=>"Nissan",
                    'Hyundai'=>"Hyundai",
                    'Kia'=>"Kia",
                    'Volkswagen'=>"Volkswagen",
                    'Mercedes-Benz'=>"Mercedes-Benz"
                ]
            ])
            ->add('modele',TextType::class,[
                'label'=> 'Modele',
                'attr'=>[
                    'placeholder'=>'Merci de saisir le modele du voiture'
                ]
            ])
            ->add('etat',ChoiceType::class,[
                'choices'=>[
                    'Neuf'=>"Neuf",
                    'Occasion'=>"Occasion",
                    'Import'=>"Import"
                ]

            ])
            ->add('prix',MoneyType::class,[
                'currency'=> 'CFA'
            ])

            ->add('photo',FileType::class,[
                'label' => "Inserer l'image",
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide',
                    ])
                ],
            ])

            ->add('submit',SubmitType::class,[
                'label'=>"Envoyer"
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DemandeVente::class,
        ]);
    }
}
