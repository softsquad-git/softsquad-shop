<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use \Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return JsonResponse
     */
    protected function successResponse()
    {
        return response()->json([
            'success' => 1
        ], 201);
    }

    /**
     * @param object $e
     * @return JsonResponse
     */
    protected function catchResponse(object $e)
    {
        return response()->json([
            'success' => 0,
            'msg' => $e->getMessage()
        ]);
    }
}
