<?php

namespace App\Services\Admin\Products;

use App\Helpers\Path;
use App\Helpers\Status;
use App\Helpers\Upload;
use App\Models\Products\Product;
use App\Models\Products\ProductPrice;
use App\Repositories\Admin\Products\ProductsRepository;
use App\Repositories\Categories\CategoryRepository;
use Dotenv\Exception\ValidationException;
use \Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductService
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var ProductsRepository
     */
    private $productsRepository;

    /**
     * @param CategoryRepository $categoryRepository
     * @param ProductsRepository $productsRepository
     */
    public function __construct(CategoryRepository $categoryRepository, ProductsRepository $productsRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productsRepository = $productsRepository;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function store(array $data)
    {
        if ($data['is_promo'] === true)
            $data['is_promo'] = 1;
        else
            $data['is_promo'] = 0;
        $categoryId = $data['category_id'];
        $this->categoryRepository->findCategory($categoryId);
        $data['user_id'] = Auth::id() ?? 1;
        $data['status'] = Status::SS_PRODUCT_ACTIVE;
        DB::beginTransaction();
        try {
            $product = Product::create($data);
        } catch (ValidationException $e) {
            throw new Exception(trans('errors.createdError'));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        $data['product_id'] = $product->id;
        try {
            ProductPrice::create($data);
        } catch (ValidationException $e) {
            DB::rollBack();
            throw new Exception(trans('errors.createdError'));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $product;
    }

    /**
     * @param array $data
     * @param int $productId
     * @return mixed
     * @throws Exception
     */
    public function update(array $data, int $productId)
    {
        if ($data['is_promo'] === true)
            $data['is_promo'] = 1;
        else
            $data['is_promo'] = 0;
        $product = $this->productsRepository->findProduct($productId);
        $product->update($data);
        $product->price->update($data);
        return $product;
    }

    /**
     * @param int $productId
     * @return bool|null
     * @throws Exception
     */
    public function remove(int $productId): ?bool
    {
        return $this->productsRepository->findProduct($productId)->delete();
    }

    /**
     * @param array $images
     * @param int $productId
     * @throws Exception
     */
    public function uploadImages(array $images, int $productId)
    {
        Upload::multiFile($images, $productId, Path::SS_PRODUCT_IMAGES);
    }
}
