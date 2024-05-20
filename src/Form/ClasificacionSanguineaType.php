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
                    'Selecciona el tipo sanguineo' => '',
                    'A' => 'A',
                    'B' => 'B',
                    'AB' => 'AB',
                    'O' => 'O',
                ],
            ])
            ->add('rh', ChoiceType::class, [
                'label' => 'Rh',
                'choices' => [
                    'Selecciona el factor' => '',
                    'Positivo' => '+',
                    'Negativo' => '-',
                ],
            ])
            ->add('donante', ChoiceType::class, [
                'label' => 'Donante',
                'choices' => [
                    'Selecciona una opción' => '',
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ClasificacionSanguinea::class,
        ]);
    }
}
