<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductRequest;
use App\Http\Resources\Products\ProductResource;
use App\Repositories\Admin\Products\ProductsRepository;
use App\Services\Admin\Products\ProductService;
use Illuminate\Http\Request;
use \Exception;
use \Illuminate\Http\JsonResponse;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * @var ProductsRepository
     */
    private $productsRepository;

    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService, ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->productService = $productService;
    }

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getProducts(Request $request)
    {
        $params = [
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'is_promo' => $request->input('is_promo'),
            'status' => $request->input('status')
        ];
        try {
            return ProductResource::collection($this->productsRepository->getProducts($params));
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
            return new ProductResource($this->productsRepository->findProduct($productId));
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request)
    {
        try {
            $product = $this->productService->store($request->all());
            if ($request->hasFile('images'))
                $this->productService->uploadImages($request->file('images'), $product->id);
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param ProductRequest $request
     * @param int $productId
     * @return JsonResponse
     */
    public function update(ProductRequest $request, int $productId)
    {
        try {
            $this->productService->update($request->all(), $productId);
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param int $productId
     * @return JsonResponse
     */
    public function remove(int $productId)
    {
        try {
            $this->productService->remove($productId);
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param int $productId
     * @return JsonResponse
     */
    public function archive(int $productId)
    {
        try {
            $this->productService->archive($productId);
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }
}
