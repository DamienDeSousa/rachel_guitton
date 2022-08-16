<?php

namespace App\Controller\Website;

use App\Form\Provider\FormProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    public function __construct(private MailerInterface $mailer, private FormProviderInterface $formProvider)
    {
    }

    #[Route('/email/send', name: 'send_contact_email', methods: ['POST'])]
    public function sendEmailAction(Request $request): Response
    {
        $form = $this->formProvider->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->sendEmail($form->getData());
            } catch (TransportExceptionInterface $e) {
                $form->addError(new FormError('message to translate'));
            }
        }

        if ($form->getErrors()->count() > 0) {
            /** @var FormError $error */
            foreach ($form->getErrors() as $error) {
                $this->addFlash('error', $error->getMessage());
            }
        } else {
            $this->addFlash('email_send', true);
        }

        return $this->redirect('/');
    }

    /**
     * @throws TransportExceptionInterface
     */
    private function sendEmail(array $decodedData): void
    {
        $this->mailer->send(
            (new Email())
                ->from($decodedData['email'])
                ->to('rachel@test.com')
                ->subject('Contact from ' . $decodedData['name'])
                ->text($decodedData['message'])
        );
    }
}
