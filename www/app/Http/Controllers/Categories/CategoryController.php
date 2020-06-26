<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CategoryRequest;
use App\Http\Resources\Categories\CategoryResource;
use App\Repositories\Categories\CategoryRepository;
use App\Services\Categories\CategoryService;
use \Exception;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @param CategoryService $categoryService
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryService $categoryService, CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryService = $categoryService;
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getAllCategories()
    {
        try {
            return CategoryResource::collection($this->categoryRepository->getAllCategories());
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getCategories(Request $request)
    {
        try {
            $params = [
                'name' => $request->input('name')
            ];
            return CategoryResource::collection($this->categoryRepository->getCategories($params));
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        try {
            $this->categoryService->store($request->all());
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param CategoryRequest $request
     * @param int $categoryId
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, int $categoryId)
    {
        try {
            $this->categoryService->update($request->all(), $categoryId);
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }

    /**
     * @param int $categoryId
     * @return JsonResponse
     */
    public function remove(int $categoryId)
    {
        try {
            $this->categoryService->remove($categoryId);
            return $this->successResponse();
        } catch (Exception $e) {
            return $this->catchResponse($e);
        }
    }
}
