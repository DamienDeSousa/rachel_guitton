<?php

namespace App\Tests\Unit\Security\Csrf;

use App\Security\Csrf\LazyCsrfTokenManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManager;

class LazyCsrfTokenManagerTest extends TestCase
{
    public function testGetToken(): void
    {
        $csrfTokenManager = $this->createMock(CsrfTokenManager::class);
        $lazyCsrfTokenManager = new LazyCsrfTokenManager($csrfTokenManager);
        $token = $lazyCsrfTokenManager->getToken('test');

        $this->assertEquals('', $token->getId());
        $this->assertEquals(null, $token->getValue());
    }

    public function testRefreshToken(): void
    {
        $csrfTokenManager = $this->createMock(CsrfTokenManager::class);
        $csrfTokenManager
            ->expects($this->once())
            ->method('refreshToken')
            ->willReturn(new CsrfToken('test', 'a_new_value'));
        $lazyCsrfTokenManager = new LazyCsrfTokenManager($csrfTokenManager);
        $token = $lazyCsrfTokenManager->refreshToken('test');

        $this->assertEquals('test', $token->getId());
        $this->assertEquals('a_new_value', $token->getValue());
    }

    public function testRemoveToken(): void
    {
        $csrfTokenManager = $this->createMock(CsrfTokenManager::class);
        $csrfTokenManager
            ->expects($this->once())
            ->method('removeToken')
            ->willReturn('test');
        $lazyCsrfTokenManager = new LazyCsrfTokenManager($csrfTokenManager);
        $tokenId = $lazyCsrfTokenManager->removeToken('test');

        $this->assertEquals('test', $tokenId);
    }

    public function testIsValidToken(): void
    {
        $csrfTokenManager = $this->createMock(CsrfTokenManager::class);
        $csrfTokenManager
            ->expects($this->once())
            ->method('isTokenValid')
            ->willReturn(true);
        $lazyCsrfTokenManager = new LazyCsrfTokenManager($csrfTokenManager);
        $isValid = $lazyCsrfTokenManager->isTokenValid(new CsrfToken('test', 'a_new_value'));

        $this->assertTrue($isValid);
    }

    public function testIsInvalidToken(): void
    {
        $csrfTokenManager = $this->createMock(CsrfTokenManager::class);
        $csrfTokenManager
            ->expects($this->once())
            ->method('isTokenValid')
            ->willReturn(false);
        $lazyCsrfTokenManager = new LazyCsrfTokenManager($csrfTokenManager);
        $isValid = $lazyCsrfTokenManager->isTokenValid(new CsrfToken('test', 'a_new_value'));

        $this->assertFalse($isValid);
    }
}
