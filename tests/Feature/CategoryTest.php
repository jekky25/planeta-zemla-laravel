<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_category_page(): void
    {
        $_SERVER['REQUEST_URI'] = '/zemlyakakplaneta/';
        $response = $this->get($_SERVER['REQUEST_URI']);
        $response->assertStatus(200);
    }
}
