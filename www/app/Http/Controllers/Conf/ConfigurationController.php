<?php

namespace App\Http\Controllers\Conf;

use App\Http\Controllers\Controller;
use App\Http\Requests\Conf\ConfigurationRequest;
use App\Services\ConfigurationService;
use \Exception;
use \Illuminate\Http\JsonResponse;

class ConfigurationController extends Controller
{
    /**
     * @var ConfigurationService
     */
    private $configurationService;

    public function __construct(ConfigurationService $configurationService)
    {
        $this->configurationService = $configurationService;
    }

    /**
     * @param ConfigurationRequest $request
     * @return JsonResponse
     */
    public function createPage(ConfigurationRequest $request)
    {
        try {
            $this->configurationService->createPage($request->all());
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }
}
