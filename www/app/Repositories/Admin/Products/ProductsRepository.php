<?php

namespace App\Repositories\Admin\Products;

use App\Models\Products\Product;
use App\Repositories\Categories\CategoryRepository;
use \Exception;

class ProductsRepository
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function getProducts(array $params)
    {
        $categoryId = $params['category_id'];
        $title = $params['title'];
        $isPromo = $params['is_promo'];
        $status = $params['status'];
        $products = Product::orderBy('id', $params['ordering'] ?? 'DESC');
        if (!empty($categoryId))
            $products->where('category_id', $categoryId);
        if (!empty($title))
            $products->where('title', 'like', '%' . $title . '%');
        if (!empty($isPromo))
            $products->where('is_promo', $isPromo);
        if (!empty($status))
            $products->where('status', $status);
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

    /**
     * @param array $ids
     * @return mixed
     */
    public static function getWhereIn(array $ids)
    {
        return Product::whereIn('id', $ids)
            ->get();
    }

    /**
     * @param string $alias
     * @param array $params
     * @return mixed
     * @throws Exception
     */
    public function getProductsCategory(string $alias, array $params)
    {
        $category = $this->categoryRepository->findCategoryAlias($alias);
        return $this->getProducts($params);
    }
}
