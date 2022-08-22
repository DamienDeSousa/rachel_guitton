<?php

namespace App\Tests\Functional\Controller\Website;

use Symfony\Component\Panther\PantherTestCase;

class SendEmailTest extends PantherTestCase
{
    public function testSendEmail(): void
    {
        $client = self::createPantherClient();
        $crawler = $client->request('GET', '/');
        //fix bug that avoid panther to scroll
        $client->executeScript('document.documentElement.style.scrollBehavior = "auto";');
        //wait ajax call
        sleep(1);
        $form = $crawler->filter('#send_email')->form([
            'contact[name]' => 'Rachel',
            'contact[email]' => 'rachel.guitton@test.fr',
            'contact[message]' => 'my message',
        ]);
        $crawler = $client->submit($form);

        $this->assertEquals(
            1,
            $crawler->filter('.alert-success')->count(),
            'Expected success flash message to de displayed, none displayed.'
        );
    }
}
