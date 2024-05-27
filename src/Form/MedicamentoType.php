<?php

namespace App\Form;

use App\Entity\Medicamento;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MedicamentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
            ])
            ->add('posologia', TextType::class, [
                'label' => 'Posología',
            ])
            ->add('duracionTratamiento', TextType::class, [
                'label' => 'Duración del Tratamiento',
            ])
            ->add('frecuencia', TextType::class, [
                'label' => 'Frecuencia',
            ])
            ->add('aplicacion', TextareaType::class, [
                'label' => 'Aplicación',
            ])
            ->add('prescripcionMedica', ChoiceType::class, [
                'label' => 'Prescripción Médica',
                'choices' => [
                    'Sí' => true,
                    'No' => false,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medicamento::class,
        ]);
    }
}
