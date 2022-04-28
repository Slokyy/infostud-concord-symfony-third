<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Vehicle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
      $yearNow = (int) date('Y');
      $yearNext = (int) date('Y', strtotime($yearNow. ' + 1 year')) ;
        $builder
          ->add('vehicle', EntityType::class, [
            'class' => Vehicle::class,
            'choice_label' => function($vehicle) {
              return $vehicle->getBrand() . ' ' . $vehicle->getModel();
            }
          ])
          ->add('date_reserved',  DateType::class, [
            'label' => 'Date Reserved ( Day / Month / Year)',
            'widget' => 'choice',
            'input'  => 'datetime_immutable',
            'format' => 'dd MM yyyy',
            'years' => range( $yearNow, $yearNext)
          ])
          ->add('save', SubmitType::class, ['label' => 'Reserve'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
