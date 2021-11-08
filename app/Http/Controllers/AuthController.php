<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Traits\JWTToken;
use Throwable;

class AuthController extends Controller
{
    use JWTToken;
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->validated();
            $shouldRespondWithToken =  auth()->attempt($credentials);
            if (!$shouldRespondWithToken) {
                return response()->json(['success' => false, 'message' => 'Credentials do not match'], 401);
            }
            return $this->respondWithToken($shouldRespondWithToken);

        } catch(Throwable $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        try {
            return response()->json([
                'success' => true, 
                'data' => auth()->user()
            ]);
            
        } catch(Throwable $e) {
            
            return response()->json(['success' => false, 'message' => $e->getMessage()]);

        }
        
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {

        try {

            if(!auth()->check()) {
                abort(500, 'No user found to logout');
            }

            auth()->logout();
                
            return response()->json(['success' => true, 'message' => 'Successfully logged out']);
        }

        catch(Throwable $e) {
            
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);

        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    
}