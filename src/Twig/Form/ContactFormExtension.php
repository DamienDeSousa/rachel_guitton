<?php

namespace App\Twig\Form;

use App\Form\Provider\FormProviderInterface;
use Symfony\Component\Form\FormView;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ContactFormExtension extends AbstractExtension
{
    public function __construct(
        private FormProviderInterface $formProvider
    ) {

    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_contact_form', [$this, 'getForm']),
        ];
    }

    public function getForm(): FormView
    {
        return $this->formProvider->getForm()->createView();
    }
}