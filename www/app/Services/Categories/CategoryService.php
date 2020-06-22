<?php

namespace App\Services\Categories;

use App\Models\Categories\Category;
use App\Repositories\Categories\CategoryRepository;
use \Exception;

class CategoryService
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
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function store(array $data)
    {
        $category = Category::create($data);
        if (empty($category))
            throw new Exception(trans('errors.createdError'));
        return $category;
    }

    /**
     * @param array $data
     * @param int $categoryId
     * @return mixed
     * @throws Exception
     */
    public function update(array $data, int $categoryId)
    {
        $category = $this->categoryRepository->findCategory($categoryId);
        $category->update($data);
        return $category;
    }

    /**
     * @param int $categoryId
     * @return bool|null
     * @throws Exception
     */
    public function remove(int $categoryId): ?bool
    {
        return $this->categoryRepository->findCategory($categoryId)->delete();
    }
}
