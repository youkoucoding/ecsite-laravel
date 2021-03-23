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
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testRegister()
    {
        $response = $this->post('wx/auth/register', [
            'username' => 'youkou',
            'password' => 'root',
            'mobile' => '1345671234',
            'code' => '1234'
        ]);
        // $response->assertStatus(200);
        $response->assertStatus(405);
        $ret = $response->getOriginalContent();
        $this->assertEquals(0, $ret['errno']);
        $this->assertNotEmpty($ret['data']);
    }

    public function testRegCaptcha()
    {
        $response = $this->post('wx/auth/regCaptcha', [
            'mobile' => '1345679034'
        ]);
        $response->assertJson(['errno' => 0, 'errmsg' => 'success']);
    }

    /**
     * 测试登录API
     */
    public function testLogin()
    {
        $response = $this->post('wx/auth/login', [
            'username' => 'taro',
            'password' => '123123123'
        ]);
        // dd($response->getOriginalContent());
    }
}
