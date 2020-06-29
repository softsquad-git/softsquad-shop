<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Services\Admin\Products\ProductImagesService;
use \Exception;

class ProductImagesController extends Controller
{
    /**
     * @var ProductImagesService
     */
    private $productImagesService;

    public function __construct(ProductImagesService $productImagesService)
    {
        $this->productImagesService = $productImagesService;
    }

    public function remove(int $imageId)
    {
        try {
            $this->productImagesService->remove($imageId);
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }
}
