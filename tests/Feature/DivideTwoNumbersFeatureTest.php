<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DivideTwoNumbersFeatureTest extends TestCase
{
	use RefreshDatabase;

	public function test_throws_unauthorized_if_no_user() {
		$route = route('divideTwoNumbers', [
			'a' => 500,
			'b' => 300
		]);

		$this->json('POST', $route)->assertJson([
			'success' => false,
			'message' => 'Unauthenticated'
		]);
	}

    public function test_returns_correct_division_of_numbers()
    {
		$this->createUser();
		$route = route('divideTwoNumbers', [
			'a' => 10,
			'b' => 2
		]);

		$this->actingAs($this->user)->json('POST', $route)->assertJson([
			'data' => 5,
			'success' => true
		]);
    }

    public function test_fails_when_dividing_wrong_input()
    {
		$this->createUser();
		$route = route('divideTwoNumbers', [
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

    public function test_fails_when_dividing_by_zero()
    {
        $this->createUser();
        $route = route('divideTwoNumbers', [
            'a' => 500,
            'b' => 0
        ]);

        $this->actingAs($this->user)
            ->json('POST', $route)
            ->assertJson([
                'success' => false,
                'message' => 'Division by zero'
                         ]);
    }
}
