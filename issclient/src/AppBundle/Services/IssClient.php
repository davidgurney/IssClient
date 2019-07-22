<?php

namespace AppBundle\Services;

use GuzzleHttp\ClientInterface;

class IssClient implements SatelliteClientInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var \GuzzleHttp\Psr7\Response
     */
    private $psrResponse;

    /**
     * @var string
     */
    private $url;

    public function __construct(ClientInterface $client, $url)
    {
		$this->client = $client;
        $this->url = $url;
    }
	
    public function getCoordinates()
    {
        $bodyContent = $this->getBodyContent();
		
        return [
            'latitude' => $bodyContent['latitude'],
            'longitude' => $bodyContent['longitude']
            ];
    }
	
    public function sendRequest(array $params = null)
    {
        $this->psrResponse = $this->client->request('GET', $this->url, [
                'query' => $params
            ]
        );
    }

    public function getBodyContent()
    {
        return json_decode((string) $this->psrResponse->getBody()->getContents(), true);
    }

    public function getStatusCode()
    {
        return $this->psrResponse->getStatusCode();
    }

}