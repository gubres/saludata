<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\HistorialContrasena;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[IsGranted('ROLE_ADMIN')]
class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                // Encode the plain password
                $hashedPassword = $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                );
                $user->setPassword($hashedPassword);

                // Actualiza la propiedad isActive
                $user->setIsActive(true); // Por defecto, el usuario estará activo al registrarse
                $user->setActualizadoEn(new \DateTime("now", new \DateTimeZone('Europe/Madrid'))); // Asignar la fecha actual
                $user->setCreadoEn(new \DateTime("now", new \DateTimeZone('Europe/Madrid'))); // Asignar la fecha actual

                // Crear entrada en HistorialContrasena
                $passwordHistory = new HistorialContrasena();
                $passwordHistory->setHashedPassword($hashedPassword);
                $passwordHistory->setUser($user);
                $passwordHistory->setChangedAt(new \DateTime("now", new \DateTimeZone('Europe/Madrid')));

                $entityManager->persist($user);
                $entityManager->persist($passwordHistory);
                $entityManager->flush();

                return $this->redirectToRoute('app_login');
            } else {
                foreach ($form->getErrors(true) as $error) {
                    $this->addFlash('danger', $error->getMessage());
                }
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
