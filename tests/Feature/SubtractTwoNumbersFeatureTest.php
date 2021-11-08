<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubtractTwoNumbersFeatureTest extends TestCase
{
	use RefreshDatabase;

	public function test_throws_unauthorized_if_no_user() {
		$route = route('subtractTwoNumbers', [
			'a' => 500,
			'b' => 300
		]);

		$this->json('POST', $route)->assertJson([
			'success' => false,
			'message' => 'Unauthenticated'
		]);
	}

    public function test_returns_correct_subtract_of_numbers()
    {
		$this->createUser();
		$route = route('subtractTwoNumbers', [
			'a' => 500,
			'b' => 300
		]);

		$this->actingAs($this->user)->json('POST', $route)->assertJson([
			'data' => 200,
			'success' => true
		]);
    }

    public function test_fails_when_subtracting_wrong_input()
    {
		$this->createUser();
		$route = route('subtractTwoNumbers', [
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
