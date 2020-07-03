<?php

namespace App\Http\Resources\Products;

use App\Helpers\Image;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsListResource extends JsonResource
{
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['category'] = [
            'name' => $this->category->name
        ];
        $data['price'] = $this->price;
        $data['image'] = Image::topProduct($this->images->first());
        return $data;
    }
}
