<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class ProductResource extends JsonResource
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['category'] = [
            'name' => $this->category->name
        ];
        $data['price'] = $this->price;
        return $data;
    }
}
