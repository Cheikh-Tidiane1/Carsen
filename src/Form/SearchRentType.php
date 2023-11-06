<?php

namespace App\Form;


use App\Classe\SearchRent;
use App\Entity\TypeVoiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchRentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut',DateType::class,[
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => true
            ])

            ->add('dateFin',DateType::class,[
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => true
            ])

            ->add('typeVoiture',EntityType::class, [
                'label' => "Type de voiture",
                'required' => true,
                'class' => TypeVoiture::class,
                'multiple' => true,
                'expanded' => false,
            ])

            ->add('submit',SubmitType::class,[
                'label' => 'Rechercher',
                'attr' => [
                    'class' => 'btn-block btn-info '
                ]
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchRent::class,
            'method'=> 'GET',
            'crsf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}