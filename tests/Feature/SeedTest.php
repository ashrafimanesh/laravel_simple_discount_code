<?php

namespace Tests\Feature;

use App\Brand;
use App\Category;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeedTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSeed()
    {

        $this->assertTrue(
            User::whereNotNull('api_token')->count() &&
            Category::count() &&
            Brand::count()
        );
    }
}
