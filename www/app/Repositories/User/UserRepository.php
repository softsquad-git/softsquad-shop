<?php

namespace App\Repositories;

use App\Helpers\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    /**
     * @param int $userId
     * @return mixed
     */
    public function findUser(int $userId)
    {
        return User::find($userId);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function getUsers(array $params)
    {
        $name = $params['name'];
        $users = User::where('role', Role::SS_R_USER)
            ->orderBy('id', 'DESC');
        if (!empty($name))
            $users->whereHas('specificData', function ($q) use ($name) {
                $q->where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%" . $name . "%");
            });
        return $users->paginate(20);
    }
}
