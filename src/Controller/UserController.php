<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserProfileFormType;
use App\Entity\HistorialContrasena;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HistorialContrasenaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/usuario')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_usuarios_index', methods: ['GET'])]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $user = $this->getUser();
        return $this->render('usuarios/index.html.twig', [
            'usuario' => $user
        ]);
    }

    #[Route('/perfil', name: 'app_usuarios_profile', methods: ['GET', 'POST'])]
    public function EditarPerfil(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        /** @var User $user */
        $user = $this->getUser();
        $form = $this->createForm(UserProfileFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();
            if ($plainPassword) {
                // Verificar si la nueva contraseña ya se ha usado
                foreach ($user->getHistorialContrasena() as $historial) {
                    if (password_verify($plainPassword, $historial->getHashedPassword())) {
                        $this->addFlash('danger', 'No puedes reutilizar una contraseña anterior.');
                        return $this->redirectToRoute('app_usuarios_profile');
                    }
                }

                // Guardar la contraseña actual en el historial
                $passwordHistory = new HistorialContrasena();
                $passwordHistory->setHashedPassword($user->getPassword());
                $passwordHistory->setUser($user);
                $passwordHistory->setChangedAt(new \DateTime("now", new \DateTimeZone('Europe/Madrid')));
                $entityManager->persist($passwordHistory);

                // Establecer la nueva contraseña
                $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
                $user->setPassword($hashedPassword);
            }

            $user->setActualizadoEn(new \DateTime("now", new \DateTimeZone('Europe/Madrid'))); // Asignar la fecha actual
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Tu perfil ha sido actualizado con éxito.');
            return $this->redirectToRoute('app_usuarios_profile');
        } elseif ($form->isSubmitted()) {
            foreach ($form->getErrors(true) as $error) {
                $this->addFlash('danger', $error->getMessage());
            }
        }

        return $this->render('usuarios/edit.html.twig', [
            'usuario' => $user,
            'form' => $form->createView(),
        ]);
    }
}
