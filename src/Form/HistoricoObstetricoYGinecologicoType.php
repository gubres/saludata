<?php

namespace App\Form;

use App\Entity\HistoricoObstetricoYGinecologico;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HistoricoObstetricoYGinecologicoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $booleanChoices = [
            'Sí' => true,
            'No' => false,
        ];

        $builder
            ->add('edadPrimeraRegla', IntegerType::class, [
                'label' => 'Edad Primera Regla'
            ])
            ->add('edadUltimaRegla', IntegerType::class, [
                'label' => 'Edad Última Regla'
            ])
            ->add('duracionRegla', IntegerType::class, [
                'label' => 'Duración Regla (días)'
            ])
            ->add('cicloRegular', ChoiceType::class, [
                'label' => 'Ciclo Regular',
                'choices' => $booleanChoices,
                'expanded' => true,
                'multiple' => false,
                'required' => true,
            ])
            ->add('usoMedicacion', ChoiceType::class, [
                'label' => 'Uso de Medicación',
                'choices' => $booleanChoices,
                'expanded' => true,
                'multiple' => false,
                'required' => true,
            ])
            ->add('medicamento', TextType::class, [
                'label' => 'Medicamento',
                'required' => false
            ])
            ->add('posologia', TextType::class, [
                'label' => 'Posología',
                'required' => false
            ])
            ->add('dolor', ChoiceType::class, [
                'label' => 'Dolor',
                'choices' => $booleanChoices,
                'expanded' => true,
                'multiple' => false,
                'required' => true,
            ])
            ->add('intensidadDolor', IntegerType::class, [
                'label' => 'Intensidad del Dolor',
                'required' => false
            ])
            ->add('tieneHijos', ChoiceType::class, [
                'label' => 'Tiene Hijos',
                'choices' => $booleanChoices,
                'expanded' => true,
                'multiple' => false,
                'required' => true,
            ])
            ->add('cantidadHijos', IntegerType::class, [
                'label' => 'Cantidad de Hijos',
                'required' => false
            ])
            ->add('tipoParto', TextType::class, [
                'label' => 'Tipo de Parto',
                'required' => false
            ])
            ->add('tiempoEntrePartos', IntegerType::class, [
                'label' => 'Tiempo entre Partos (meses)',
                'required' => false
            ])
            ->add('edadPrimeroParto', DateType::class, [
                'label' => 'Edad del Primer Parto',
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('edadUltimoParto', DateType::class, [
                'label' => 'Edad del Último Parto',
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('citologiaVaginal', ChoiceType::class, [
                'label' => 'Citología Vaginal',
                'choices' => $booleanChoices,
                'expanded' => true,
                'multiple' => false,
                'required' => true,
            ])
            ->add('primeraColeta', DateType::class, [
                'label' => 'Primera Coleta',
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('ultimaColeta', DateType::class, [
                'label' => 'Última Coleta',
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('resultadoColeta', TextType::class, [
                'label' => 'Resultado de la Coleta',
                'required' => false
            ])
            ->add('cancerDeMama', ChoiceType::class, [
                'label' => 'Cáncer de Mama',
                'choices' => $booleanChoices,
                'expanded' => true,
                'multiple' => false,
                'required' => true,
            ])
            ->add('fechaCancer', DateType::class, [
                'label' => 'Fecha del Cáncer',
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('tratamientoCancer', TextType::class, [
                'label' => 'Tratamiento del Cáncer',
                'required' => false
            ])
            ->add('vph', ChoiceType::class, [
                'label' => 'VPH',
                'choices' => $booleanChoices,
                'expanded' => true,
                'multiple' => false,
                'required' => true,
            ])
            ->add('tratamientoVph', TextType::class, [
                'label' => 'Tratamiento VPH',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HistoricoObstetricoYGinecologico::class,
        ]);
    }
}
