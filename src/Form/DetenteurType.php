<?php

namespace App\Form;

use App\Entity\Detenteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetenteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('postnom')
            ->add('prenom')
            ->add('date_naissance')
            ->add('sexe')
            ->add('marque')
            ->add('modele')
            ->add('type')
            ->add('poids')
            ->add('couleur')
            ->add('plaque')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Detenteur::class,
        ]);
    }
}
