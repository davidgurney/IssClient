<?php
// src/AppBundle/Controller/Api/IssClientController.php

namespace AppBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Services\SubmitLatLng;

class IssClientController
{
    /**
     * @var \AppBundle\Services\SatelliteClientInterface
     */	
	private $client;	
	
    /**
     * @var int
     */
	private $id;
	
    public function __construct($client, $id)
    {
		$this->client = $client;
		$this->id = $id;		
    }	
	
    public function get(Request $request)
    {
		$this->client->sendRequest(array('id'=> $this->id));
		$coordinates = $this->client->getCoordinates();
        try {
			$issLatLng = new SubmitLatLng(
				$coordinates['latitude'],
				$coordinates['longitude']
			);
			return new JsonResponse($issLatLng, 200);
        } catch (\InvalidArgumentException $e) {
			return new JsonResponse($e->getMessage(), 400);
        }		
        
    }
}