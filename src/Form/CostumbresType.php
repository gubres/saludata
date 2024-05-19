<?php

namespace App\Form;

use App\Entity\Costumbres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\DBAL\Types\BooleanType;

class CostumbresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fumante', BooleanType::class, [
                'label' => 'Fumante',
            ])
            ->add('frecuenciaFuma', IntegerType::class, [
                'label' => 'Frecuencia Fuma (cigarrillos/día)',
            ])
            ->add('edadEmpezoFumar', IntegerType::class, [
                'label' => 'Edad Empezó a Fumar',
            ])
            ->add('consumoAlcohol', BooleanType::class, [
                'label' => 'Consumo de Alcohol',
            ])
            ->add('frecuenciaConsumoAlcohol', IntegerType::class, [
                'label' => 'Frecuencia Consumo Alcohol (veces/semana)',
            ])
            ->add('edadEmpezoBeber', IntegerType::class, [
                'label' => 'Edad Empezó a Beber',
            ])
            ->add('otrasDrogas', BooleanType::class, [
                'label' => 'Otras Drogas',
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
            ->add('actividadFisica', BooleanType::class, [
                'label' => 'Actividad Física',
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
            ->add('actividadSexual', BooleanType::class, [
                'label' => 'Actividad Sexual',
            ])
            ->add('edadPrimeraRelacionSexual', IntegerType::class, [
                'label' => 'Edad Primera Relación Sexual',
            ])
            ->add('frecuenciaActividadSexual', TextType::class, [
                'label' => 'Frecuencia de la Actividad Sexual',
            ])
            ->add('usoDePreservativo', BooleanType::class, [
                'label' => 'Uso de Preservativo',
            ])
            ->add('parejasSexualesActual', IntegerType::class, [
                'label' => 'Parejas Sexuales Actual',
            ])
            ->add('higieneIntima', BooleanType::class, [
                'label' => 'Higiene Íntima',
            ])
            ->add('metodoHigieneIntima', TextType::class, [
                'label' => 'Método de Higiene Íntima',
            ])
            ->add('creadoEn', DateType::class, [
                'label' => 'Creado En',
                'widget' => 'single_text',
                'disabled' => true,
                'data' => new \DateTime('now')
            ])
            ->add('actualizadoEn', DateType::class, [
                'label' => 'Actualizado En',
                'widget' => 'single_text',
                'disabled' => true,
                'data' => new \DateTime('now')
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Costumbres::class,
        ]);
    }
}
