<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
    public function profile(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        /** @var User $user */
        $user = $this->getUser();
        $form = $this->createForm(UserProfileFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('plainPassword')->getData()) {
                $password = $passwordHasher->hashPassword($user, $form->get('plainPassword')->getData());
                $user->setPassword($password);
            }
            $user->setActualizadoEn(new \DateTime("now", new \DateTimeZone('Europe/Madrid'))); // Asignar la fecha actual
            $entityManager->persist($user);
            $entityManager->flush();

            if ($request->isXmlHttpRequest()) {
                return $this->json(['success' => true]);
            }

            $this->addFlash('success', 'Tu perfil ha sido actualizado con éxito.');
            return $this->redirectToRoute('app_usuarios_profile');
        }

        if ($request->isXmlHttpRequest()) {
            return $this->json(['success' => false, 'message' => 'Formulario no válido.']);
        }

        return $this->render('usuarios/edit.html.twig', [
            'usuario' => $user,
            'form' => $form->createView(),
        ]);
    }
}
