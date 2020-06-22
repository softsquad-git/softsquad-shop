<?php

namespace App\Repositories\Categories;

use App\Models\Categories\Category;
use \Exception;
use \Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    /**
     * @param int $categoryId
     * @return mixed
     * @throws Exception
     */
    public function findCategory(int $categoryId)
    {
        $category = Category::find($categoryId);
        if (empty($category))
            throw new Exception(trans('errors.noObject'));
        return $category;
    }

    /**
     * @return Category[]|Collection
     */
    public function getAllCategories()
    {
        return Category::all();
    }
}
