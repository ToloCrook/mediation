<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(MailerInterface $mailer, Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userEmail = $form->getData()['Email'];
            $subject = $form->getData()['Sujet'];
            $message = $form->getData()['Message'];

            $email =(new Email())
                ->from($userEmail)
                ->to('talence.mediation@gmail.com')
                ->subject($subject)
                ->html($message);
            $mailer->send($email);
            $this->addFlash('success', 'Message envoyé !');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form,
        ]);
    }
}
