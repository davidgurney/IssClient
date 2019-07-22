<?php

// src/AppBundle/Services/SubmitLatLng.php

namespace AppBundle\Services;

class SubmitLatLng
{
    public $latitude;
    
    public $longitude;
    
    public function __construct($lat, $lon)
    {
        if (false === is_numeric($lat) or false === is_numeric($lon)) {
            throw new \DomainException("Expected two float arguments.", 422);
        }
        if ($lat > 90 || $lat < -90 || $lon > 180 || $lon < -180) {
            throw new \DomainException('Expects latitude between -90 and 90 and longitude between -180 and 180', 422);
        }
        $this->latitude = $lat;
        $this->longitude = $lon;
    }
}
