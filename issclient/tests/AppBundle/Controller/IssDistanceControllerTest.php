<?php
// tests/AppBundle/Controller/Api/IssDistanceControllerTest.php

namespace Tests\AppBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;

class IssDistanceControllerTest extends \PHPUnit_Framework_TestCase
{
    private $app;

    protected function setUp()
    {
        $this->app = new \AppKernel('test', false);
    }

    /**
     * @test
     */
    public function it_cannot_get_a_distance_without_position()
    {
        $headers = array(
            'CONTENT_TYPE' => 'application/json',
        );
        $request = Request::create('/api/v1/issdistance', 'POST', array(), array(), array(), $headers, json_encode(array(
        )));

        $response = $this->app->handle($request);

        self::assertSame(422, $response->getStatusCode(), $response->getContent());
    }
	
	/**
     * @test
     */
    public function it_cannot_get_distances_without_a_proper_position()
    {
        $headers = array(
            'CONTENT_TYPE' => 'application/json',
        );
        $request = Request::create('/api/v1/issdistance', 'POST', array(), array(), array(), $headers, json_encode(array(
            'latitude' => 'barry',
            'longitude' => 'bonds',
        )));
        $response = $this->app->handle($request);
        self::assertSame(422, $response->getStatusCode(), $response->getContent());	
    }     

	/**
     * @test
     */
    public function it_get_distances_with_two_floats()
    {
        $headers = array(
            'CONTENT_TYPE' => 'application/json',
        );
        $request = Request::create('/api/v1/issdistance', 'POST', array(), array(), array(), $headers, json_encode(array(
            'latitude' => '3.465',
            'longitude' => '-2.345',
        )));
        $response = $this->app->handle($request);
        self::assertSame(200, $response->getStatusCode(), $response->getContent());	
    }
	
}