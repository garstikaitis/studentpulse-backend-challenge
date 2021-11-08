<?php

namespace App\Traits;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

trait UserValidation {
	public function validateUser() {
		$user = auth('api')->check();
		abort_if(!$user, 401, 'Unauthenticated');

		$authorizationHeader = request()->header('Authorization');
		abort_if(!$authorizationHeader, 401, 'Authorization header must be present');

		try {
			if (!$user = JWTAuth::parseToken()->authenticate()) {
				abort(401, 'User not found');
			}
		} catch (TokenExpiredException $e) {
			abort(401, 'Token expired');
		} catch (TokenInvalidException $e) {
			abort(401, 'Token invalid');
		} catch (JWTException $e) {
			abort(401, 'Token was not provided');
        }
	}
}