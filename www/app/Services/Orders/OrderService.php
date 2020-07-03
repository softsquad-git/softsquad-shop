<?php

namespace App\Services\Orders;

use App\Models\Orders\Order;
use App\Repositories\Admin\Orders\OrderRepository;
use App\Repositories\Admin\Orders\Shipments\ShipmentRepository;
use App\Repositories\Admin\Products\ProductsRepository;
use Illuminate\Support\Facades\Auth;
use \Exception;

class OrderService
{
    /**
     * @var ProductsRepository
     */
    private $productRepository;

    /**
     * @var ShipmentRepository
     */
    private $shipmentRepository;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function __construct(
        ProductsRepository $productsRepository,
        OrderRepository $orderRepository,
        ShipmentRepository $shipmentRepository
    )
    {
        $this->productRepository = $productsRepository;
        $this->orderRepository = $orderRepository;
        $this->shipmentRepository = $shipmentRepository;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function store(array $data)
    {
        $data['user_id'] = Auth::id() ?? 0;
        $data['products_ids'] = json_encode($data['products_ids']);
        $this->shipmentRepository->findShipment($data['shipment_id']);
        $order = Order::create($data);
        if (empty($order))
            throw new Exception(trans('errors.createdObject'));
        return $order;
    }
}
