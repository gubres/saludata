<?php

namespace App\Form;

use App\Entity\ExamenMiembrosInferiores;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExamenMiembrosInferioresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('inspeccion', TextareaType::class, [
                'label' => 'Inspección',
            ])
            ->add('palpacion', TextareaType::class, [
                'label' => 'Palpación',
            ])
            ->add('percusion', TextareaType::class, [
                'label' => 'Percusión',
            ])
            ->add('ausculta', TextareaType::class, [
                'label' => 'Ausculta',
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
            'data_class' => ExamenMiembrosInferiores::class,
        ]);
    }
}
