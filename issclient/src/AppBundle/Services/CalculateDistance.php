<?php

// src/AppBundle/Services/CalculateDistance.php

namespace AppBundle\Services;

class CalculateDistance
{
    public $lat1;
    
    public $lon1;

    public $lat2;
    
    public $lon2;

    public function __construct($lat1, $lon1, $lat2, $lon2)
    {
        $this->lat1 = $lat1;
        $this->lon1 = $lon1;
        $this->lat2 = $lat2;
        $this->lon2 = $lon2;
    }
    
    /**
     * Get distance between two coordinates
     *
     * @return float
     * @param  int     $decimals[optional] The amount of decimals
     * @param  string  $unit[optional]
     */
    public function between($decimals = 1, $unit = 'km')
    {
        // define calculation variables
        $theta = $this->lon1 - $this->lon2;
        
        $distance = (sin(deg2rad($this->lat1)) * sin(deg2rad($this->lat2)))
            + (cos(deg2rad($this->lat1)) * cos(deg2rad($this->lat2)) * cos(deg2rad($theta)));
            
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;

        if ($unit == 'km') {
            $distance = $distance * 1.609344;
        }
        return round($distance, $decimals);
    }
}
