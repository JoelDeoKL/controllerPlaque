<?php

namespace App\Form;

use App\Entity\ControleTech;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ControleTechType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque')
            ->add('type')
            ->add('modele')
            ->add('miseCirculation')
            ->add('numChassis')
            ->add('date_delivrance')
            ->add('date_expiration')
            ->add('numPlaque')
            ->add('editer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ControleTech::class,
        ]);
    }
}
