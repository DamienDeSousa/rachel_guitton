<?php

namespace App\Tests\Functional\Controller\Website;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class FormTokenControllerTest extends TestCase
{
    public function testTokenAction(): void
    {
        $client = new Client(['base_uri' => 'http://localhost']);
        $response = $client->get('/_form/token?form=contact');
        $httpCode = $response->getStatusCode();
        $csrfToken = $response->getBody()->getContents();

        $this->assertEquals(200, $httpCode);
        $this->assertIsString($csrfToken);
    }
}
