<?php

namespace AppBundle\Services;

use GuzzleHttp\ClientInterface;

interface SatelliteClientInterface
{
    public function __construct(ClientInterface $client, $url);
	
    public function sendRequest(array $params);

    public function getBodyContent();

    public function getStatusCode();
}