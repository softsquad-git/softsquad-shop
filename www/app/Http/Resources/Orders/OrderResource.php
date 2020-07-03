<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['shipment'] = $this->shipment->name ?? '';
        return $data;
    }
}
