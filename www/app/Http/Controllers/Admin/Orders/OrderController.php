<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Http\Resources\Orders\OrderResource;
use App\Repositories\Admin\Orders\OrderRepository;
use App\Services\Admin\Orders\OrderService;
use Illuminate\Http\Request;
use \Exception;
use \Illuminate\Http\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @param OrderService $orderService
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderService $orderService, OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
    }

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getAllOrders(Request $request)
    {
        $params = [
            'user_id' => $request->input('user_id'),
            'email' => $request->input('email'),
            'status' => $request->input('status')
        ];
        try {
            return OrderResource::collection($this->orderRepository->getAllOrders($params));
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param int $orderId
     * @return OrderResource|JsonResponse
     */
    public function findOrder(int $orderId)
    {
        try {
            return new OrderResource($this->orderRepository->findOrder($orderId));
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }
}
