<?php

namespace App\Http\Resources\Products;

use App\Helpers\Path;
use Illuminate\Http\Resources\Json\JsonResource;
use \Illuminate\Http\Request;

class ProductImagesResource extends JsonResource
{
    /**
     * @param Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'src' => asset(Path::SS_PRODUCT_IMAGES.$this->src)
        ];
    }
}
