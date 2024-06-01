<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'disabled' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, introduzca su email',
                    ]),
                ],
                'error_bubbling' => true,
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'invalid_message' => 'Las contraseñas no coinciden',
                'first_options' => ['label' => 'Contraseña', 'attr' => ['autocomplete' => 'new-password']],
                'second_options' => ['label' => 'Repite Contraseña', 'attr' => ['autocomplete' => 'new-password']],
                'constraints' => [
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
