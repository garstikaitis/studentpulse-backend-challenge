<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Traits\JWTToken;

class RegisterController extends Controller
{
    use JWTToken;
    public function register(RegisterRequest $request)
    {
        try {
			$credentials = $request->validated();
			$user = User::create($credentials);
			$token = auth()->login($user);
            return $this->respondWithToken($token);
        } catch(Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
