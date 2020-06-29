<?php

namespace App\Services\Admin\Orders\Shipments;

use App\Models\Orders\Shipment;
use App\Repositories\Admin\Orders\Shipments\ShipmentRepository;
use \Exception;

class ShipmentService
{
    /**
     * @var ShipmentRepository
     */
    private $shipmentRepository;

    public function __construct(ShipmentRepository $shipmentRepository)
    {
        $this->shipmentRepository = $shipmentRepository;
    }

    /**
     * @param array $data
     * @return Shipment|null
     * @throws Exception
     */
    public function store(array $data): ?Shipment
    {
        $item = Shipment::create($data);
        if (empty($item))
            throw new Exception(trans('errors.createdObject'));
        return $item;
    }

    public function update(array $data, int $shipmentId): ?Shipment
    {
        $item = $this->shipmentRepository->findShipment($shipmentId);
        $item->update($data);
        return $item;
    }

    public function remove(int $shipmentId): ?bool
    {
        return $this->shipmentRepository->findShipment($shipmentId)->delete();
    }
}
