<?php

namespace App\Form;

use App\Entity\SignosVitales;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SignosVitalesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('altura', IntegerType::class, [
                'label' => 'Altura (cm)',
            ])
            ->add('peso', NumberType::class, [
                'label' => 'Peso (kg)',
            ])
            ->add('masaCorporal', NumberType::class, [
                'label' => 'Masa Corporal (kg/m²)',
            ])
            ->add('temperatura', NumberType::class, [
                'label' => 'Temperatura (°C)',
            ])
            ->add('frecuenciaRespiratoria', IntegerType::class, [
                'label' => 'Frecuencia Respiratoria',
            ])
            ->add('sistole', NumberType::class, [
                'label' => 'Sístole',
            ])
            ->add('diastole', NumberType::class, [
                'label' => 'Diástole',
            ])
            ->add('frecuenciaCardiaca', IntegerType::class, [
                'label' => 'Frecuencia Cardiaca',
            ])
            ->add('porcentajeGrasaCorporal', NumberType::class, [
                'label' => 'Porcentaje Grasa Corporal',
            ])
            ->add('masaCorporalMagra', NumberType::class, [
                'label' => 'Masa Corporal Magra',
            ])
            ->add('saturacionOxigeno', IntegerType::class, [
                'label' => 'Saturación Oxígeno',
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
            'data_class' => SignosVitales::class,
        ]);
    }
}
