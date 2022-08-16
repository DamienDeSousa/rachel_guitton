<?php

namespace App\Form\Provider;

use App\Security\Csrf\LazyCsrfTokenManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class LazyContactFormProvider implements FormProviderInterface
{
    public function __construct(
        private ContactFormProvider $contactFormProvider,
        private CsrfTokenManagerInterface $csrfTokenManager
    ) {

    }

    public function getForm(array $options = []): FormInterface
    {
        return $this->contactFormProvider->getForm(
            ['csrf_token_manager' => new LazyCsrfTokenManager($this->csrfTokenManager)]
        );
    }
}
