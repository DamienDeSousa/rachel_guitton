<?php

namespace App\Controller\Website;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class FormTokenController
{
    public function __construct(private CsrfTokenManagerInterface $csrfTokenManager)
    {
    }

    public function tokenAction(Request $request): Response
    {
        $formName = $request->get('form');
        $csrfToken = $this->csrfTokenManager->getToken($formName)->getValue();

        $content = $csrfToken;

        $response = new Response($content);

        /* Deactivate Cache for this token action */
        $response->setSharedMaxAge(0);
        $response->setMaxAge(0);
        // set shared will set the request to public, so it need to be done after shared max set to 0
        $response->setPrivate();
        $response->headers->addCacheControlDirective('no-cache');
        $response->headers->addCacheControlDirective('must-revalidate');
        $response->headers->addCacheControlDirective('no-store');

        return $response;
    }
}
