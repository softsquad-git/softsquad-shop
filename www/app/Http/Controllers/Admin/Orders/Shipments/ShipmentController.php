<?php

namespace App\Http\Controllers\Admin\Orders\Shipments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Orders\Shipments\ShipmentRequest;
use App\Http\Resources\Shipments\ShipmentResource;
use App\Repositories\Admin\Orders\Shipments\ShipmentRepository;
use App\Services\Admin\Orders\Shipments\ShipmentService;
use \Exception;
use \Illuminate\Http\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ShipmentController extends Controller
{
    /**
     * @var ShipmentRepository
     */
    private $shipmentRepository;

    /**
     * @var ShipmentService
     */
    private $shipmentService;

    /**
     * @param ShipmentService $shipmentService
     * @param ShipmentRepository $shipmentRepository
     */
    public function __construct(ShipmentService $shipmentService, ShipmentRepository $shipmentRepository)
    {
        $this->shipmentRepository = $shipmentRepository;
        $this->shipmentService = $shipmentService;
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getAllShipments()
    {
        try {
            return ShipmentResource::collection($this->shipmentRepository->getAllShipments());
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param ShipmentRequest $request
     * @param int $shipmentId
     * @return JsonResponse
     */
    public function update(ShipmentRequest $request, int $shipmentId)
    {
        try {
            $this->shipmentService->update($request->all(), $shipmentId);
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param ShipmentRequest $request
     * @return JsonResponse
     */
    public function store(ShipmentRequest $request)
    {
        try {
            $this->shipmentService->store($request->all());
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param int $shipmentId
     * @return JsonResponse
     */
    public function remove(int $shipmentId)
    {
        try {
            $this->shipmentService->remove($shipmentId);
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param int $shipmentId
     * @return ShipmentResource|JsonResponse
     */
    public function findShipment(int $shipmentId)
    {
        try {
            return new ShipmentResource($this->shipmentRepository->findShipment($shipmentId));
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }
}
