<?php

namespace App\Traits;

trait JWTToken {
	public function respondWithToken($token)
    {
        $user = auth()->user();
        return response()->json([
            'success' => true,
            'data' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'user' => $user,
            ]
        ], 200);
    }
}