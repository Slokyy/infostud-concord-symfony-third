<?php

namespace App\Form;

use App\Entity\Driver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DriverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('birthdate', DateType::class, [
              'widget' => 'choice',
              'input'  => 'datetime_immutable',
              'format' => 'dd MM yyyy',
              'years' => range(1970,2005)
            ])
            ->add('city', TextType::class)
            ->add('email', TextType::class)
            ->add('phone',  TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Add Driver'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Driver::class,
        ]);
    }
}
