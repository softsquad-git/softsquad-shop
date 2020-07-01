<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UserDataResource;
use App\Http\Resources\Users\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use \Exception;
use \Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers(Request $request)
    {
        $params = [
            'name' => $request->input('name')
        ];
        try {
            return UserResource::collection($this->userRepository->getUsers($params));
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param int $userId
     * @return UserDataResource|JsonResponse
     */
    public function findUser(int $userId)
    {
        try {
            return new UserDataResource($this->userRepository->findUser($userId));
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }
}
