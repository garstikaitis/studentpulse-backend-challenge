<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthFeatureTest extends TestCase
{
    public function test_user_can_login_and_get_token()
    {
		$route = route('login');
		$this->createUser();
        $response = $this->json(
			'POST', 
			$route,
			['email' => $this->user->email, 'password' => 'password']
		)->assertStatus(200);

		$json = $response->decodeResponseJson();
		$this->assertTrue($json['data']['token_type'] === 'bearer');
	}

    public function test_user_can_register()
    {
		$route = route('register');
		$this->createUser();
        $response = $this->json(
			'POST', 
			$route,
			['email' => '123@gmail.com', 'password' => 'password', 'name' => 'John Doe']
		)->assertStatus(200);

		$json = $response->decodeResponseJson();
		$this->assertTrue($json['data']['token_type'] === 'bearer');
	}
	
    public function test_user_can_not_get_token()
    {
		$this->createUser();
		$route = route('login');

    	$response = $this->json(
			'POST', 
			$route,
			['email' => $this->user->email, 'password' => 'password23423423']
		)->assertStatus(401);
		$json = $response->decodeResponseJson();
		$this->assertTrue($json['message'] === 'Credentials do not match');
	}
	
	public function test_user_can_not_logout_if_not_logged_in() {
		$route = route('logout');
		$response = $this->json('POST', $route)
			->assertStatus(500);
		$json = $response->decodeResponseJson();
		$this->assertTrue($json['message'] === 'No user found to logout');
	}

	public function test_user_can_logout() {
		$this->createUser();
		$route = route('logout');
		$response = $this->actingAs($this->user)
			->json('POST', $route)
			->assertStatus(200);

		$json = $response->decodeResponseJson();
		$this->assertTrue($json['message'] === 'Successfully logged out');
	}

	public function test_user_can_get_me() {
		$this->createUser();
		$route = route('me');
		$response = $this->actingAs($this->user)->json('POST', $route)->assertStatus(200);
		$json = $response->decodeResponseJson();
		$user = $json['data'];
		$this->assertTrue($user['email'] === $this->user->email);
	}
}
