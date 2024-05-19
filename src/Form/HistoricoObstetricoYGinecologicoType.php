<?php

namespace App\Form;

use App\Entity\HistoricoObstetricoYGinecologico;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Doctrine\DBAL\Types\TextType;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HistoricoObstetricoYGinecologicoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
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
            ->add('cicloRegular', CheckboxType::class, [
                'label' => 'Ciclo Regular',
                'required' => false
            ])
            ->add('usoMedicacion', CheckboxType::class, [
                'label' => 'Uso de Medicación',
                'required' => false
            ])
            ->add('medicamento', TextType::class, [
                'label' => 'Medicamento',
                'required' => false
            ])
            ->add('posologia', TextType::class, [
                'label' => 'Posología',
                'required' => false
            ])
            ->add('dolor', CheckboxType::class, [
                'label' => 'Dolor',
                'required' => false
            ])
            ->add('intensidadDolor', IntegerType::class, [
                'label' => 'Intensidad del Dolor',
                'required' => false
            ])
            ->add('tieneHijos', CheckboxType::class, [
                'label' => 'Tiene Hijos',
                'required' => false
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
            ->add('citologiaVaginal', CheckboxType::class, [
                'label' => 'Citología Vaginal',
                'required' => false
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
            ->add('cancerDeMama', CheckboxType::class, [
                'label' => 'Cáncer de Mama',
                'required' => false
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
            ->add('vph', CheckboxType::class, [
                'label' => 'VPH',
                'required' => false
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
