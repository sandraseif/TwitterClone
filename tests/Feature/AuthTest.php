<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /**
     * @test 
     * Test registration
     */
    public function testRegister(){
        //User's data
        $data = [
            'email'     => 'sandratestaccount@gmail.com',
            'name'      => 'sandra test',
            'password'  => 'test123',
            'password_confirmation' => 'test123',
        ];
        //Send post request
        $response = $this->json('POST',route('api.register'),$data);
        //Assert it was successful
        $response->assertStatus(200);
        //Assert we received a token
        $this->assertArrayHasKey('token',$response->json());
        //Delete data
        User::where('email','sandratestaccount@gmail.com')->delete();
    }
    /**
     * @test
     * Test login
     */
    public function testLogin()
    {
        //Create user
        User::create([
            'name' => 'sandra test',
            'email'=>'sandratestaccount@gmail.com',
            'password' => bcrypt('test123')
        ]);
        //attempt login
        $response = $this->json('POST',route('api.authenticate'),[
            'email'    => 'sandratestaccount@gmail.com',
            'password' => 'test123',
        ]);
        //Assert it was successful and a token was received
        $response->assertStatus(200);
        $this->assertArrayHasKey('token',$response->json());
        //Delete the user
    }  
}
