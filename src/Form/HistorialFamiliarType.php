<?php

namespace App\Form;

use App\Entity\HistorialFamiliar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HistorialFamiliarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('padreVivo', ChoiceType::class, [
                'label' => 'Padre Vivo',
                'choices' => [
                    'Sí' => true,
                    'No' => false,
                ],
            ])
            ->add('madreVivo', ChoiceType::class, [
                'label' => 'Madre Viva',
                'choices' => [
                    'Sí' => true,
                    'No' => false,
                ],
            ])
            ->add('hermanos', IntegerType::class, [
                'label' => 'Hermanos',
            ])
            ->add('hermanosVivos', ChoiceType::class, [
                'label' => 'Hermanos Vivos',
                'choices' => [
                    'Sí' => true,
                    'No' => false,
                ],
            ])
            ->add('hijos', IntegerType::class, [
                'label' => 'Hijos',
            ])
            ->add('hijosVivos', ChoiceType::class, [
                'label' => 'Hijos Vivos',
                'choices' => [
                    'Sí' => true,
                    'No' => false,
                ],
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
            ->add('diabetes', ChoiceType::class, [
                'label' => 'Diabetes',
                'choices' => [
                    'Sí' => true,
                    'No' => false,
                ],
            ])
            ->add('enfermedadCardiaca', ChoiceType::class, [
                'label' => 'Enfermedad Cardiaca',
                'choices' => [
                    'Sí' => true,
                    'No' => false,
                ],
            ])
            ->add('hipertension', ChoiceType::class, [
                'label' => 'Hipertensión',
                'choices' => [
                    'Sí' => true,
                    'No' => false,
                ],
            ])
            ->add('enfermedadMetabolica', ChoiceType::class, [
                'label' => 'Enfermedad Metabólica',
                'choices' => [
                    'Sí' => true,
                    'No' => false,
                ],
            ])
            ->add('cancer', ChoiceType::class, [
                'label' => 'Cáncer',
                'choices' => [
                    'Sí' => true,
                    'No' => false,
                ],
            ])
            ->add('tipoCancer', TextareaType::class, [
                'label' => 'Tipo de Cáncer',
            ])
            ->add('enfermedadRenalCronica', ChoiceType::class, [
                'label' => 'Enfermedad Renal Crónica',
                'choices' => [
                    'Sí' => true,
                    'No' => false,
                ],
            ])
            ->add('otraEnfermedadCronica', TextareaType::class, [
                'label' => 'Otra Enfermedad Crónica',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HistorialFamiliar::class,
        ]);
    }
}
