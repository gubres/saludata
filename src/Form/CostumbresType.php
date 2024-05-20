<?php

namespace App\Form;

use App\Entity\Costumbres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CostumbresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $booleanChoices = [
            'Sí' => true,
            'No' => false,
        ];

        $builder
            ->add('fumante', ChoiceType::class, [
                'label' => 'Fumante',
                'choices' => $booleanChoices,
            ])
            ->add('frecuenciaFuma', IntegerType::class, [
                'label' => 'Frecuencia Fuma (cigarrillos/día)',
            ])
            ->add('edadEmpezoFumar', IntegerType::class, [
                'label' => 'Edad Empezó a Fumar',
            ])
            ->add('consumoAlcohol', ChoiceType::class, [
                'label' => 'Consumo de Alcohol',
                'choices' => $booleanChoices,
            ])
            ->add('frecuenciaConsumoAlcohol', IntegerType::class, [
                'label' => 'Frecuencia Consumo Alcohol (veces/semana)',
            ])
            ->add('edadEmpezoBeber', IntegerType::class, [
                'label' => 'Edad Empezó a Beber',
            ])
            ->add('otrasDrogas', ChoiceType::class, [
                'label' => 'Otras Drogas',
                'choices' => $booleanChoices,
            ])
            ->add('tipoDrogas', TextType::class, [
                'label' => 'Tipo de Drogas',
            ])
            ->add('frecuencia', TextType::class, [
                'label' => 'Frecuencia',
            ])
            ->add('edadEmpezoUsar', IntegerType::class, [
                'label' => 'Edad Empezó a Usar',
            ])
            ->add('actividadFisica', ChoiceType::class, [
                'label' => 'Actividad Física',
                'choices' => $booleanChoices,
            ])
            ->add('tipoActividadFisica', TextType::class, [
                'label' => 'Tipo de Actividad Física',
            ])
            ->add('duracionActividadFisica', TextType::class, [
                'label' => 'Duración de la Actividad Física',
            ])
            ->add('frecuenciaActividadFisica', TextType::class, [
                'label' => 'Frecuencia de la Actividad Física',
            ])
            ->add('actividadSexual', ChoiceType::class, [
                'label' => 'Actividad Sexual',
                'choices' => $booleanChoices,
            ])
            ->add('edadPrimeraRelacionSexual', IntegerType::class, [
                'label' => 'Edad Primera Relación Sexual',
            ])
            ->add('frecuenciaActividadSexual', TextType::class, [
                'label' => 'Frecuencia de la Actividad Sexual',
            ])
            ->add('usoPreservativo', ChoiceType::class, [
                'label' => 'Uso de Preservativo',
                'choices' => $booleanChoices,
            ])
            ->add('parejasSexualesActual', IntegerType::class, [
                'label' => 'Parejas Sexuales Actual',
            ])
            ->add('higieneIntima', ChoiceType::class, [
                'label' => 'Higiene Íntima',
                'choices' => $booleanChoices,
            ])
            ->add('metodoHigieneIntima', TextType::class, [
                'label' => 'Método de Higiene Íntima',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Costumbres::class,
        ]);
    }
}
