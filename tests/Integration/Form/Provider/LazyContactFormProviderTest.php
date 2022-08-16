<?php

namespace App\Tests\Integration\Form\Provider;

use App\Form\Provider\LazyContactFormProvider;
use App\Form\Type\ContactType;
use App\Security\Csrf\LazyCsrfTokenManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LazyContactFormProviderTest extends KernelTestCase
{
    public function testGetForm(): void
    {
        static::bootKernel();
        /** @var LazyContactFormProvider $lazyContactFormProvider */
        $lazyContactFormProvider = self::getContainer()->get(LazyContactFormProvider::class);
        $form = $lazyContactFormProvider->getForm();
        $csrfTokenManager = $form->getConfig()->getOption('csrf_token_manager');

        $this->assertInstanceOf(LazyCsrfTokenManager::class, $csrfTokenManager);
        $this->assertInstanceOf(ContactType::class, $form->getConfig()->getType()->getInnerType());
    }
}