<?php

namespace App\Form;

use App\Entity\CarteCrise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CarteCriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('noms')
            ->add('adresse')
            ->add('numImpot')
            ->add('dateMiseCirculation')
            ->add('typeUsage')
            ->add('dateDelivrance')
            ->add('numPlaque')
            ->add('editer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CarteCrise::class,
        ]);
    }
}
