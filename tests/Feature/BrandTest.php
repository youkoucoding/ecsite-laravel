<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BrandTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDetail()
    {
        $response = $this->get('wx/brand/detail');

        $response->assertStatus(200);
    }

    public function testList()
    {
        $response = $this->get('wx/brand/list');
        $response->assertStatus(200);
    }
}
