<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FeedBackTest extends TestCase
{
	/**
	* A basic feature test example.
	*/
	public function test_feed_back_page(): void
	{
		$_SERVER['REQUEST_URI'] = '/feedback/';
		$response = $this->get($_SERVER['REQUEST_URI']);
		$response->assertStatus(200);
	}
}
