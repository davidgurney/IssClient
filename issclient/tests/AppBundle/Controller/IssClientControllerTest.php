<?php
// tests/AppBundle/Controller/Api/IssPositionControllerTest.php

namespace Tests\AppBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;

class IssPositionControllerTest extends \PHPUnit_Framework_TestCase
{
    private $app;

    protected function setUp()
    {
        $this->app = new \AppKernel('test', false);
    }

    /**
     * @test
     */
    public function it_exists_as_an_endpoint()
    {
        $headers = array(
            'CONTENT_TYPE' => 'application/json',
        );
        $request = Request::create('/api/v1/issposition', 'GET', array(), array(), array(), $headers, json_encode(array(
        )));

        $response = $this->app->handle($request);

        self::assertSame(200, $response->getStatusCode(), $response->getContent());
    }
	
    /**
     * @test
     */
    public function it_emits_a_position()
    {
        $headers = array(
            'CONTENT_TYPE' => 'application/json',
        );
        $request = Request::create('/api/v1/issposition', 'GET', array(), array(), array(), $headers, json_encode(array(
        )));

        $response = $this->app->handle($request);
		
		$this->assertEquals(200, $response->getStatusCode());
		$finishedData = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('latitude', $finishedData);		
        $this->assertArrayHasKey('longitude', $finishedData);		

    }	

}