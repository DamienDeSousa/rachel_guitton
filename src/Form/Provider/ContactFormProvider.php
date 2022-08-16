<?php

declare(strict_types=1);

namespace App\Form\Provider;

use App\Form\Type\ContactType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\RouterInterface;

class ContactFormProvider implements FormProviderInterface
{
    public function __construct(private FormFactoryInterface $formFactory, private RouterInterface $router)
    {

    }

    public function getForm(array $options = []): FormInterface
    {
        $mergedOptions = array_merge(
            [
                'action' => $this->router->generate('send_contact_email'),
                'method' => 'POST',
            ],
            $options
        );

        return $this->formFactory->create(
            ContactType::class,
            [],
            $mergedOptions
        );
    }
}