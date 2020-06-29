<?php

namespace App\Repositories\Admin\Orders\Shipments;

use App\Models\Orders\Shipment;
use \Exception;

class ShipmentRepository
{
    public function getAllShipments()
    {
        return Shipment::all();
    }

    /**
     * @param int $shipmentId
     * @return mixed
     * @throws Exception
     */
    public function findShipment(int $shipmentId)
    {
        $item = Shipment::find($shipmentId);
        if (empty($item))
            throw new Exception(trans('errors.noObject'));
        return $item;
    }
}
