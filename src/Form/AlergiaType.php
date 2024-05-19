<?php

namespace App\Form;

use App\Entity\Alergia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlergiaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
            ])
            ->add('causa', TextareaType::class, [
                'label' => 'Causa',
            ])
            ->add('primeraVez', DateType::class, [
                'label' => 'Primera Vez',
                'widget' => 'single_text',
            ])
            ->add('frecuencia', TextType::class, [
                'label' => 'Frecuencia',
            ])
            ->add('tratamientoRealizado', TextareaType::class, [
                'label' => 'Tratamiento Realizado',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Alergia::class,
        ]);
    }
}
