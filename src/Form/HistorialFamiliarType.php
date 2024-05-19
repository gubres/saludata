<?php

namespace App\Form;

use App\Entity\HistorialFamiliar;
use Symfony\Component\Form\AbstractType;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HistorialFamiliarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('padreVivo', BooleanType::class, [
                'label' => 'Padre Vivo',
            ])
            ->add('madreVivo', BooleanType::class, [
                'label' => 'Madre Viva',
            ])
            ->add('hermanos', IntegerType::class, [
                'label' => 'Hermanos',
            ])
            ->add('hermanosVivos', BooleanType::class, [
                'label' => 'Hermanos Vivos',
            ])
            ->add('hijos', IntegerType::class, [
                'label' => 'Hijos',
            ])
            ->add('hijosVivos', BooleanType::class, [
                'label' => 'Hijos Vivos',
            ])
            ->add('edadFallecimientoHijos', IntegerType::class, [
                'label' => 'Edad Fallecimiento Hijos',
            ])
            ->add('edadFallecimientoPadre', IntegerType::class, [
                'label' => 'Edad Fallecimiento Padre',
            ])
            ->add('edadFallecimientoMadre', IntegerType::class, [
                'label' => 'Edad Fallecimiento Madre',
            ])
            ->add('edadFallecimientoHermanos', IntegerType::class, [
                'label' => 'Edad Fallecimiento Hermanos',
            ])
            ->add('causaMuertePadre', TextareaType::class, [
                'label' => 'Causa Muerte Padre',
            ])
            ->add('causaMuerteMadre', TextareaType::class, [
                'label' => 'Causa Muerte Madre',
            ])
            ->add('causaMuerteHermanos', TextareaType::class, [
                'label' => 'Causa Muerte Hermanos',
            ])
            ->add('diabetes', BooleanType::class, [
                'label' => 'Diabetes',
            ])
            ->add('enfermedadCardiaca', BooleanType::class, [
                'label' => 'Enfermedad Cardiaca',
            ])
            ->add('hipertension', BooleanType::class, [
                'label' => 'Hipertensión',
            ])
            ->add('enfermedadMetabolica', BooleanType::class, [
                'label' => 'Enfermedad Metabólica',
            ])
            ->add('cancer', BooleanType::class, [
                'label' => 'Cáncer',
            ])
            ->add('tipoCancer', TextareaType::class, [
                'label' => 'Tipo de Cáncer',
            ])
            ->add('enfermedadRenalCronica', BooleanType::class, [
                'label' => 'Enfermedad Renal Crónica',
            ])
            ->add('otraEnfermedadCronica', TextareaType::class, [
                'label' => 'Otra Enfermedad Crónica',
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
            'data_class' => HistorialFamiliar::class,
        ]);
    }
}
