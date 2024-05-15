<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactoController extends AbstractController
{
    #[Route('/contacto', name: 'app_contacto')]
    public function contact(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('name', TextType::class, ['label' => 'Nombre'])
            ->add('email', EmailType::class, ['label' => 'Correo electrónico'])
            ->add('problem', TextareaType::class, ['label' => 'Descripción del problema'])
            ->add('save', SubmitType::class, ['label' => 'Enviar'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Aquí puedes manejar el envío del formulario, como enviar un correo electrónico
            $this->addFlash('success', 'Su mensaje ha sido enviado.');
            return $this->redirectToRoute('contacto');
        }

        return $this->render('contacto/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
