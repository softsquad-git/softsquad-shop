<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user_id' => Auth::id(),
            'success' => 1,
            'name' => Auth::user()->specificData->name . ' ' . Auth::user()->specificData->last_name
        ]);
    }
}
