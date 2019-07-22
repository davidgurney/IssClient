<?php

namespace Tests\AppBundle\Services;

use AppBundle\Services\IssClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use GuzzleHttp\Client as GuzzleClient;

class ISSClientTest extends WebTestCase
{
    /**
     * @var String
     */	
	private $url = 'https://api.wheretheiss.at/v1/satellites/';
    /**
     * @var ISSClient
     */
    private $client;

    public function setUp()
    {
		$client = static::createClient();
		
        $mock = new MockHandler([
            new Response(200,
                ['Content-Type' =>  'application/json'],
                fopen(__DIR__ . '/mock/ISSClient/body/200.txt', 'rb+'))
        ]);

        $handler = HandlerStack::create($mock);

        $this->client = new ISSClient(new GuzzleClient(['handler' => $handler]), $this->url);

        $this->client->sendRequest();
    }	
	
    public function testGetStatusCode()
    {
        $this->assertSame(200, $this->client->getStatusCode());
    }

    public function testGetCoordinates()
    {
        $result = $this->client->getCoordinates();

        $this->assertArrayHasKey('latitude', $result);
        $this->assertArrayHasKey('longitude', $result);
    }	
}