<?php
// src/AppBundle/Controller/Api/IssDistanceController.php

namespace AppBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Services\SubmitLatLng;
use AppBundle\Services\CalculateDistance;

class IssDistanceController
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
	
    public function distance(Request $request)
    {
        $distance = 0;
        

		$latLng = new SubmitLatLng(
			$request->request->get('latitude'),
			$request->request->get('longitude')
		);
						
		$this->client->sendRequest(array('id'=> $this->id));
		$coordinates = $this->client->getCoordinates();	
		
		$issLatLng = new SubmitLatLng(
			$coordinates['latitude'],
			$coordinates['longitude']
		);
		
		if (($latLng->latitude == $issLatLng->latitude) && ($latLng->longitude == $issLatLng->longitude)) {
			$distance = 0;
		} else {
			$calc = new CalculateDistance(
				$latLng->latitude,
				$latLng->longitude,
				$issLatLng->latitude,
				$issLatLng->longitude
			);
			$distance = $calc->between(3);
		}
		return new JsonResponse(array('distance' => $distance, 'units' => 'km'), 200);

    }
}