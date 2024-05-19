<?php

namespace App\Form;

use App\Entity\ClasificacionSanguinea;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClasificacionSanguineaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tipo', ChoiceType::class, [
                'label' => 'Tipo',
                'choices' => [
                    'A' => 'A',
                    'B' => 'B',
                    'AB' => 'AB',
                    'O' => 'O',
                ],
            ])
            ->add('rh', ChoiceType::class, [
                'label' => 'Rh',
                'choices' => [
                    'Positivo' => '+',
                    'Negativo' => '-',
                ],
            ])
            ->add('donante', ChoiceType::class, [
                'label' => 'Donante',
                'choices' => [
                    'Sí' => true,
                    'No' => false,
                ],
            ])
            ->add('descripcion', TextareaType::class, [
                'label' => 'Descripción',
            ])
            ->add('ultimaDonacion', DateType::class, [
                'label' => 'Última Donación',
                'widget' => 'single_text',
            ])
            ->add('frecuencia', TextType::class, [
                'label' => 'Frecuencia',
            ])
            ->add('creadoEn', DateType::class, [
                'label' => 'Creado En',
                'widget' => 'single_text',
                'disabled' => true,
                'data' => new \DateTime('now')
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ClasificacionSanguinea::class,
        ]);
    }
}
