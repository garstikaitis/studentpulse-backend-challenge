<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MultiplyTwoNumbersFeatureTest extends TestCase
{
	use RefreshDatabase;

	public function test_throws_unauthorized_if_no_user() {
		$route = route('multiplyTwoNumbers', [
			'a' => 500,
			'b' => 300
		]);

		$this->json('POST', $route)->assertJson([
			'success' => false,
			'message' => 'Unauthenticated'
		]);
	}

    public function test_returns_correct_multiply_of_numbers()
    {
		$this->createUser();
		$route = route('multiplyTwoNumbers', [
			'a' => 2,
			'b' => 4
		]);

		$this->actingAs($this->user)->json('POST', $route)->assertJson([
			'data' => 8,
			'success' => true
		]);
    }

    public function test_fails_when_multiplying_wrong_input()
    {
		$this->createUser();
		$route = route('multiplyTwoNumbers', [
			'a' => 'Test',
			'b' => 300
		]);

		$this->actingAs($this->user)
			->json('POST', $route)
			->assertStatus(422)
			->assertJson([
				'errors' => [
					'a' => [
						'The a must be a number.'  
					]
				]
			]);
    }
}
