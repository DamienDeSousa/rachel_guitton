<?php

namespace App\Tests\Integration\Form\Provider;

use App\Form\Provider\ContactFormProvider;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ContactFormProviderTest extends KernelTestCase
{
    public function testGetForm(): void
    {
        static::bootKernel();
        /** @var ContactFormProvider $contactFormProvider */
        $contactFormProvider = self::getContainer()->get(ContactFormProvider::class);
        $form = $contactFormProvider->getForm();

        $this->assertEquals('/email/send', $form->getConfig()->getAction());
        $this->assertEquals('POST', $form->getConfig()->getMethod());
    }
}
