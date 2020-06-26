<?php

namespace App\Http\Resources\Products;

use App\Helpers\Image;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class ProductResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['category'] = [
            'name' => $this->category->name
        ];
        $data['price'] = $this->price;
        $data['image'] = Image::topProduct($this->images->first());
        $data['images'] = ProductImagesResource::collection($this->images);
        return $data;
    }
}
