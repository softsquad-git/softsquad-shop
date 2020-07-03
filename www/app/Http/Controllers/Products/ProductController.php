<?php

namespace App\Http\Controllers\Products;

use App\Helpers\Status;
use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductResource;
use App\Http\Resources\Products\ProductsListResource;
use App\Repositories\Admin\Products\ProductsRepository;
use Illuminate\Http\Request;
use \Exception;
use \Illuminate\Http\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * @var ProductsRepository
     */
    private $productRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productRepository = $productsRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getProducts(Request $request)
    {
        try {
            $params = [
                'title' => $request->input('title'),
                'category_id' => $request->input('category_id'),
                'status' => Status::SS_PRODUCT_ACTIVE,
                'is_promo' => $request->input('is_promo')
            ];
            return ProductsListResource::collection($this->productRepository->getProducts($params));
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param int $productId
     * @return ProductResource|JsonResponse
     */
    public function findProduct(int $productId)
    {
        try {
            return new ProductResource($this->productRepository->findProduct($productId));
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param Request $request
     * @param string $alias
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getProductsCategory(Request $request, string $alias)
    {
        try {
            $params = [
                'title' => $request->input('title'),
                'category_id' => $request->input('category_id'),
                'status' => Status::SS_PRODUCT_ACTIVE,
                'is_promo' => $request->input('is_promo')
            ];
            return ProductsListResource::collection($this->productRepository->getProductsCategory($alias, $params));
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }
}
