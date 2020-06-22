<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use \Exception;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var AuthService
     */
    private $authService;

    /**
     * @param AuthService $authService
     * @param UserRepository $userRepository
     */
    public function __construct(AuthService $authService, UserRepository $userRepository)
    {
        $this->authService = $authService;
        $this->userRepository = $userRepository;
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function registerUser(RegisterRequest $request)
    {
        try {
            $this->authService->registerUser($request->all());
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);
            if (!$token = Auth::attempt($credentials)) {
                return response()->json([
                    'error' => 'Unauthorized',
                    'status' => 401
                ], 401);
            }
            return $this->userRepository->respondWithToken($token);
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @return JsonResponse
     */
    public function logout()
    {
        try {
            Auth::guard('api')->logout();
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }
}
