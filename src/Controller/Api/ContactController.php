<?php

namespace App\Controller\Api;

use App\Form\Type\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ContactController extends AbstractController
{
    public function __construct(private ValidatorInterface $validator, private MailerInterface $mailer)
    {
    }

    #[Route('/api/email/send', name: 'send_contact_email', methods: ['POST'])]
    public function sendEmailAction(Request $request): Response
    {
        $emptyData = [
            'name' => '',
            'email' => '',
            'message' => '',
        ];
        $form = $this->createForm(
            ContactType::class,
            $emptyData,
            [
                'action' => $this->generateUrl('send_contact_email'),
                'method' => 'POST',
            ]
        );

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
                $error->getMessage();
            }
        }

        return $this->redirect('/');
    }

    /**
     * @throws TransportExceptionInterface
     */
    private function sendEmail(array $decodedData): void
    {
        $this->mailer->send(
            (new \Symfony\Component\Mime\Email())
                ->from($decodedData['email'])
                ->to('rachel@test.com')
                ->subject('Contact from ' . $decodedData['name'])
                ->text($decodedData['message'])
        );
    }

//    private function validate(array $decodedData): array
//    {
//        $constraints = new Collection([
//            'name' => [new NotBlank(), new Type('string')],
//            'email' => [new NotBlank(), new Email()],
//            'message' => [new NotBlank(), new Type('string')],
//        ]);
//
//        $code = 200;
//        $message = ['result' => 'email sent'];
//        $violations = $this->validator->validate($decodedData, $constraints);
//        if (count($violations) > 0) {
//            $code = 400;
//            $message = [];
//            /** @var ConstraintViolation $violation */
//            foreach ($violations as $violation) {
//                $message[str_replace(['[', ']'], '', $violation->getPropertyPath())][] = $violation->getMessage();
//            }
//        }
//
//        return [$code, $message];
//    }
}