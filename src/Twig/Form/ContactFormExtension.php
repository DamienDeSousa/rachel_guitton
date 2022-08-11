<?php

namespace App\Twig\Form;

use App\Form\Type\ContactType;
use App\Security\Csrf\LazyCsrfTokenManager;
use Sulu\Bundle\FormBundle\Csrf\DisabledCsrfTokenManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ContactFormExtension extends AbstractExtension
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private RouterInterface $router,
        private RequestStack $requestStack,
        private CsrfTokenManagerInterface $csrfTokenManager
    ) {

    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_contact_form', [$this, 'getContactForm']),
        ];
    }

    public function getContactForm(Request $request): FormView
    {
        $requestSession = $request->getSession();
        $session = $this->requestStack->getSession();
        $isStarted = $session->isStarted();
        $emptyData = [
            'name' => '',
            'email' => '',
            'message' => '',
        ];

        $form = $this->formFactory->create(
            ContactType::class,
            $emptyData,
            [
                'action' => $this->router->generate('send_contact_email'),
                'method' => 'POST',
                'csrf_token_manager' => new LazyCsrfTokenManager($this->csrfTokenManager),
            ]);

        $form->handleRequest($request);

        return $form->createView();
    }
}