<?php

namespace App\Form;

use App\Entity\ExamenPelvico;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExamenPelvicoType extends AbstractType
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExamenPelvico::class,
        ]);
    }
}
