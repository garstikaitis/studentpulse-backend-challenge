<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddTwoNumbersFeatureTest extends TestCase
{
	use RefreshDatabase;

	public function test_throws_unauthorized_if_no_user() {
		$route = route('addTwoNumbers', [
			'a' => 500,
			'b' => 300
		]);

		$this->json('POST', $route)->assertJson([
			'success' => false,
			'message' => 'Unauthenticated'
		]);
	}
    public function test_returns_correct_sum_of_numbers()
    {
		$this->createUser();
		$route = route('addTwoNumbers', [
			'a' => 500,
			'b' => 300
		]);

		$this->actingAs($this->user)->json('POST', $route)->assertJson([
			'data' => 800,
			'success' => true
		]);
    }

    public function test_fails_when_adding_wrong_input()
    {
		$this->createUser();
		$route = route('addTwoNumbers', [
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
