<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CatalogTest extends TestCase
{

    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->assertLitemallApiGet('wx/catalog/index');
        $this->assertLitemallApiGet('wx/catalog/index?id=1005000');
    }

    public function testCurrent()
    {
        $this->assertLitemallApiGet('wx/catalog/current', ['errmsg']);
        $this->assertLitemallApiGet('wx/catalog/current?id=1005000');
    }
}
