<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Email;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, introduzca su correo electrónico',
                    ]),
                    new Email([
                        'message' => 'Por favor, introduzca un correo electrónico válido',
                    ]),
                ],
                'error_bubbling' => true,
            ])
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, introduzca su nombre',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
                        'message' => 'El nombre solo puede contener letras',
                    ]),
                ],
                'error_bubbling' => true,
            ])
            ->add('apellidos', TextType::class, [
                'label' => 'Apellidos',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, introduzca sus apellidos',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
                        'message' => 'Los apellidos solo pueden contener letras',
                    ]),
                ],
                'error_bubbling' => true,
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Debe aceptar nuestros términos.',
                    ]),
                ],
                'error_bubbling' => true,
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Las contraseñas no coinciden',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, introduzca la contraseña',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Su contraseña debe tener al menos {{ limit }} caracteres',
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}/',
                        'message' => 'La contraseña debe contener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula, un número y un carácter especial',
                    ]),
                ],
                'error_bubbling' => true,
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
