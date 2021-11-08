<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThrottleAPIRequestsFeatureTest extends TestCase
{
	use RefreshDatabase;

	public function test_throttling_requests_correctly_calculates_requests() {
		$route = route('me');
		$response = $this->json('GET', $route);
		$this->assertTrue($response->headers->get('x-ratelimit-limit') === "5");
		$this->assertTrue($response->headers->get('x-ratelimit-remaining') === "4");
		$response = $this->json('GET', $route);
		$this->assertTrue($response->headers->get('x-ratelimit-limit') === "5");
		$this->assertTrue($response->headers->get('x-ratelimit-remaining') === "3");
		$response = $this->json('GET', $route);
		$response = $this->json('GET', $route);
		$response = $this->json('GET', $route);
		$response = $this->json('GET', $route);
		$json = $response->decodeResponseJson();
		$this->assertTrue($json['message'] === "Too Many Attempts.");
	}
}
