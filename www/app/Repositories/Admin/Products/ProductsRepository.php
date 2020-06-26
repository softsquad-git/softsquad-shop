<?php

namespace App\Repositories\Admin\Products;

use App\Models\Products\Product;
use \Exception;

class ProductsRepository
{
    /**
     * @param array $params
     * @return mixed
     */
    public function getProducts(array $params)
    {
        $categoryId = $params['category_id'];
        $title = $params['title'];
        $isPromo = $params['is_promo'];
        $products = Product::orderBy('id', $params['ordering'] ?? 'DESC');
        if (!empty($categoryId))
            $products->where('category_id', $categoryId);
        if (!empty($title))
            $products->where('title', 'like', '%' . $title . '%');
        if (!empty($isPromo))
            $products->where('is_promo', $isPromo);
        return $products
            ->paginate($params['pagination'] ?? 20);
    }

    /**
     * @param int $productId
     * @return mixed
     * @throws Exception
     */
    public function findProduct(int $productId)
    {
        $product = Product::find($productId);
        if (empty($product))
            throw new Exception(trans('errors.noObject'));
        return $product;
    }

    public function getImagesProduct(int $productId)
    {

    }
}
