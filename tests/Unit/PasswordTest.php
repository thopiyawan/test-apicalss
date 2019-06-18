<?php

namespace Tests\Unit;

use App\password;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class PasswordTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCheckpassword()
    {
        // $this->assertTrue(true);
        $password = new password;
        $result = $password->check('12345678');
        $resulttrue = $password->check('A122b');
        $result1 = $password->check('12345678',true);
        $this->assertFalse($result);
        $this->assertFalse($result1);
        $this->assertTrue($resulttrue);
    }
    // public function testCheckAdmin()
    // {
    //     // $this->assertTrue(true);
    //     $password = new password;
    //     $result = $password->check('12345678',true);
    //     $this->assertFalse($result);
     
    // }
  

}
