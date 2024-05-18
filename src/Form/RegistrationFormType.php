<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, introduzca su nombre',
                    ]),
                ],
            ])
            ->add('apellidos', TextType::class, [
                'label' => 'Apellidos',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, introduzca sus apellidos',
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Debe aceptar nuestros términos.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false, // esto asegura que no se intentará mapear directamente a la entidad
                'invalid_message' => 'Las contraseñas no coinciden',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, introduzca la contraseña',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Su contraseña debe tener al menos {{ limit }} caracteres',
                        'max' => 4096,
                    ]),
                ],
                'first_options'  => ['label' => 'Contraseña', 'attr' => ['autocomplete' => 'new-password']],
                'second_options' => ['label' => 'Repite Contraseña', 'attr' => ['autocomplete' => 'new-password']],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
