<?php
// tests/AppBundle/Services/CalculateDistanceTest.php

namespace Tests\AppBundle\Services;

use AppBundle\Services\CalculateDistance;

class CalculateDistanceTest extends \PHPUnit_Framework_TestCase
{

    public $latitude1;
	
    public $longitude1;

    public $latitude2;
	
    public $longitude2;
		 
    /**
     * Set up before class
     *
     * @return void
     */
    public function setUp()
    {
        // first location
        $this->latitude1 = '50.8538510000';
        $this->longitude1 = '3.3550450000';
        // second location
        $this->latitude2 = '50.8325600000';
        $this->longitude2 = '3.4787650000';

    }
    /**
     * Test get distance between two locations
     */
    public function testGetDistanceBetweenTwoLocations()
    {
        $distance = new CalculateDistance(
            $this->latitude1,
            $this->longitude1,
            $this->latitude2,
            $this->longitude2
        );
        $this->assertEquals(9, $distance->between());
    }
	
}	