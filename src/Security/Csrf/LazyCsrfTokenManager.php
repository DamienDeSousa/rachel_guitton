<?php

namespace App\Security\Csrf;

use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class LazyCsrfTokenManager implements CsrfTokenManagerInterface
{
    public function __construct(private CsrfTokenManagerInterface $csrfTokenManager)
    {
    }

    public function getToken(string $tokenId): CsrfToken
    {
        return new CsrfToken('', null);
    }

    public function refreshToken(string $tokenId): CsrfToken
    {
        return $this->csrfTokenManager->refreshToken($tokenId);
    }

    public function removeToken(string $tokenId): ?string
    {
        return $this->csrfTokenManager->removeToken($tokenId);
    }

    public function isTokenValid(CsrfToken $token): bool
    {
        return $this->csrfTokenManager->isTokenValid($token);
    }
}