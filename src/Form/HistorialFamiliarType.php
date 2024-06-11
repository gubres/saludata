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
            ->add('edadFallecimientoPadre', IntegerType::class, [
                'label' => 'Edad Fallecimiento Padre',
                'required' => false,
            ])
            ->add('edadFallecimientoMadre', IntegerType::class, [
                'label' => 'Edad Fallecimiento Madre',
                'required' => false,
            ])
            ->add('causaMuertePadre', TextareaType::class, [
                'label' => 'Causa Muerte Padre',
                'required' => false,
            ])
            ->add('causaMuerteMadre', TextareaType::class, [
                'label' => 'Causa Muerte Madre',
                'required' => false,
            ])
            ->add('causaMuerteHermanos', TextareaType::class, [
                'label' => 'Causa Muerte Hermanos',
                'required' => false,
            ])
            ->add('diabetes', ChoiceType::class, [
                'label' => 'Diabetes',
                'choices' => [
                    'No' => false,
                    'Sí' => true,

                ],
            ])
            ->add('enfermedadCardiaca', ChoiceType::class, [
                'label' => 'Enfermedad Cardiaca',
                'choices' => [
                    'No' => false,
                    'Sí' => true,
                ],
            ])
            ->add('hipertension', ChoiceType::class, [
                'label' => 'Hipertensión',
                'choices' => [
                    'No' => false,
                    'Sí' => true,
                ],
            ])
            ->add('enfermedadMetabolica', ChoiceType::class, [
                'label' => 'Enfermedad Metabólica',
                'choices' => [
                    'No' => false,
                    'Sí' => true,
                ],
            ])
            ->add('cancer', ChoiceType::class, [
                'label' => 'Cáncer',
                'choices' => [
                    'No' => false,
                    'Sí' => true,
                ],
            ])
            ->add('tipoCancer', TextareaType::class, [
                'label' => 'Tipo de Cáncer',
                'required' => false,
            ])
            ->add('enfermedadRenalCronica', ChoiceType::class, [
                'label' => 'Enfermedad Renal Crónica',
                'choices' => [
                    'No' => false,
                    'Sí' => true,
                ],
            ])
            ->add('otraEnfermedadCronica', TextareaType::class, [
                'label' => 'Otra Enfermedad Crónica',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HistorialFamiliar::class,
        ]);
    }
}
