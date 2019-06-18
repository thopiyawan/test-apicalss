<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Hospital;

class HospitalApiTest extends TestCase
{
  
    use RefreshDatabase;

    // protected function setUp(): void{
    //     parent::setUp();
    //     factory(Hospital::class,10)->create();
    // }


    public function testGetAllHospitals() {
        // Arrange - create 10 hospitals
      
        $hospital = factory(Hospital::class,10)->create();
        // Act - make a json call to /api/hospitals
        $response = $this->json('get','/api/hospitals');
     

        // Assert - check that status 200
        $response->assertStatus(200);
        $response->assertJsonCount(11);
        //        - check that there are 10 objects in the array


    }
    // public function testGetHospital() {
    //     // Arrange - create a hospital, get the id
    //     $hospital = factory(Hospital::class)->create();
    //     // Act - make a json call to /api/hospitals/{id}
    //     $response = $this->json('get','/api/hospitals/{id}');
    //     // Assert - check that status 200
    //     $response->assertStatus(200);
    //     //        - check that the data matches (name, address, etc)
    // }
    
    
}
