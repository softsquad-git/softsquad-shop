<?php

namespace App\Services\Admin\Products;

use App\Repositories\Admin\Products\ProductImagesRepository;
use \Exception;

class ProductImagesService
{
    /**
     * @var ProductImagesRepository
     */
    private $productImagesRepository;

    /**
     * @param ProductImagesRepository $productImagesRepository
     */
    public function __construct(ProductImagesRepository $productImagesRepository)
    {
        $this->productImagesRepository = $productImagesRepository;
    }

    /**
     * @param int $imageId
     * @return bool|null
     * @throws Exception
     */
    public function remove(int $imageId): ?bool
    {
        return $this->productImagesRepository->findImage($imageId)->delete();
    }
}
