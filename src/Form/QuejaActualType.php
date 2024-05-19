<?php

namespace App\Form;

use App\Entity\QuejaActual;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuejaActualType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('queja', TextType::class, [
                'label' => 'Queja',
            ])
            ->add('descripcion', TextareaType::class, [
                'label' => 'Descripción',
            ])
            ->add('cuandoEmpezo', DateType::class, [
                'label' => 'Cuándo Empezó',
                'widget' => 'single_text',
            ])
            ->add('duracion', TextType::class, [
                'label' => 'Duración',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => QuejaActual::class,
        ]);
    }
}
