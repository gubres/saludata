<?php

namespace App\Form;

use App\Entity\Medicamento;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
            ->add('prescripcionMedica', BooleanType::class, [
                'label' => 'Prescripción Médica',
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
            'data_class' => Medicamento::class,
        ]);
    }
}
