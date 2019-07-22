<?php
// tests/AppBundle/Services/SubmitLatLngTest.php

namespace Tests\AppBundle\Services;

use AppBundle\Services\SubmitLatLng;

class SubmitLatLngTest extends \PHPUnit_Framework_TestCase
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
     * @test
     */
    public function it_fails_if_theres_no_lat()
    {
        $this->expectException(\DomainException::class);
        new SubmitLatLng(null, 3);
    }
	
	/**
     * @test
     */
    public function it_fails_if_theres_no_lng()
    {
        $this->expectException(\DomainException::class);
        new SubmitLatLng(3,null);
    }

	/**
     * @test
     */
    public function it_fails_if_lat_isnt_a_number()
    {
        $this->expectException(\DomainException::class);
        new SubmitLatLng("barry",3);
    }

	/**
     * @test
     */
    public function it_fails_if_lng_isnt_a_number()
    {
        $this->expectException(\DomainException::class);
        new SubmitLatLng(3,"barry");
    }	
	
	/**
     * @test
     */
    public function it_fails_if_lat_is_over_90()
    {
        $this->expectException(\DomainException::class);
        new SubmitLatLng(91,3);
    }	
	
	/**
     * @test
     */
    public function it_fails_if_lat_is_under_minus_90()
    {
        $this->expectException(\DomainException::class);
        new SubmitLatLng(-91,3);
    }	

	/**
     * @test
     */
    public function it_fails_if_lng_is_over_180()
    {
        $this->expectException(\DomainException::class);
        new SubmitLatLng(3,181);
    }	
    
	/**
     * @test
     */
    public function it_fails_if_lng_is_under_minus_180()
    {
        $this->expectException(\DomainException::class);
        new SubmitLatLng(3,-181);
    }		
}	