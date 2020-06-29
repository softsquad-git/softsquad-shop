<?php

namespace App\Repositories\Admin\Products;

use App\Models\Products\ProductImage;
use \Exception;

class ProductImagesRepository
{
    /**
     * @param int $imageId
     * @return mixed
     * @throws Exception
     */
    public function findImage(int $imageId)
    {
        $image = ProductImage::find($imageId);
        if (empty($image))
            throw new Exception(trans('errors.noObject'));
        return $image;
    }
}
