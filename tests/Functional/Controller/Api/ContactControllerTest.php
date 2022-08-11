<?php

namespace App\Tests\Functional\Controller\Api;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ContactControllerTest extends TestCase
{
    public function testSendEmailEndpoint(): void
    {
        $client = new Client(['base_uri' => 'http://localhost']);
        $dataToSend = [
            'name' => 'Damien',
            'email' => 'damien@test.com',
            'message' => 'This is a test message',
        ];
        $response = $client->post(
            '/api/email/send',
            [
                'body' => json_encode($dataToSend),
            ]
        );
        $httpCode = $response->getStatusCode();
        $successMessage = json_decode($response->getBody()->getContents(), true);

        $this->assertEquals(200, $httpCode);
        $this->assertEquals('email sent', $successMessage['result']);
    }

    public function testSendWrongEmailEndpoint(): void
    {
        $client = new Client(['base_uri' => 'http://localhost', 'http_errors' => false]);
        $dataToSend = [
            'name' => '',
            'email' => '',
            'message' => '',
        ];
        $response = $client->post(
            '/api/email/send',
            [
                'body' => json_encode($dataToSend),
            ]
        );
        $decodedErrors = json_decode($response->getBody()->getContents(), true);


        $this->assertArrayHasKey('name', $decodedErrors);
        $this->assertArrayHasKey('email', $decodedErrors);
        $this->assertArrayHasKey('message', $decodedErrors);
    }

    public function testSendEmailWithWrongAddressEmailEndpoint(): void
    {
        $client = new Client(['base_uri' => 'http://localhost', 'http_errors' => false]);
        $dataToSend = [
            'name' => 'Damien',
            'email' => 'wrong_email',
            'message' => 'message',
        ];
        $response = $client->post(
            '/api/email/send',
            [
                'body' => json_encode($dataToSend),
            ]
        );
        $decodedErrors = json_decode($response->getBody()->getContents(), true);


        $this->assertArrayHasKey('email', $decodedErrors);
    }
}
