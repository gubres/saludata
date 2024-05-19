<?php

namespace App\Form;

use App\Entity\ResultadoPrueba;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResultadoPruebaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombrePrueba', TextType::class, [
                'label' => 'Nombre Prueba',
            ])
            ->add('fecha', DateType::class, [
                'label' => 'Fecha',
                'widget' => 'single_text',
            ])
            ->add('resultado', TextareaType::class, [
                'label' => 'Resultado',
            ])
            ->add('archivo', FileType::class, [
                'label' => 'Archivo (PDF)',
                'required' => false,
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
            'data_class' => ResultadoPrueba::class,
        ]);
    }
}
