<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Hospital;

class HospitalDatabaseTest extends TestCase
{
    use RefreshDatabase,WithFaker;

    protected function setUp(): void{
        parent::setUp();
        for($i = 0; $i<10 ; $i++){
            $name = 'Nectec1 hospital1';
            $address = 'TSP1';
            $numberOfBeds = '1001';
            $numberOfDoctors = '61';
    
           $hospital = Hospital::create($name, $address, $numberOfBeds, $numberOfDoctors);
    
           $hospital->save();
    
        }
    }












    public function testSaveModel()
    {

        
        $name = 'Nectec hospital';
        $address = 'TSP';
        $numberOfBeds = '100';
        $numberOfDoctors = '6';

       $hospital = Hospital::create($name, $address, $numberOfBeds, $numberOfDoctors);

       $hospital->save();

       $this->assertDatabaseHas('hospitals', ['name' => $name]);
    }

    public function testUpdateModel()
    {

        
        $name = 'Nectec hospital';
        $address = 'TSP';
        $numberOfBeds = '100';
        $numberOfDoctors = '6';

       $hospital = Hospital::create($name, $address, $numberOfBeds, $numberOfDoctors);

       $hospital->name = 'NU Hospital';
       $hospital->save();

       $this->assertDatabaseHas('hospitals', ['name' => 'NU Hospital']);
       $this->assertDatabaseMissing('hospitals', ['name' => $name]);
    }


}