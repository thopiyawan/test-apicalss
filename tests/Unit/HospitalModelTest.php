<?php

namespace Tests\Unit;

use App\Hospital;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Exceptions\ValidationException;

class HospitalModelTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateModel()
    {

        
        $name = 'Nectec hospital';
        $address = 'TSP';
        $numberOfBeds = '100';
        $numberOfDoctors = '6';

       $hospital =  Hospital::create($name, $address, $numberOfBeds, $numberOfDoctors);

        $this->assertEquals($name, $hospital->name , 'incorect hospital name');
    }

    public function testCreateModel_ex()
    {

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('Invalid name');
        
       $hospital =   Hospital::create('', 'a', '3', '3');
    //    $this->assertEquals($name, $hospital->name , 'incorect hospital name');

       
    }

   
   

}
