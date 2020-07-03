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

    /**
     * @param array $params
     * @return mixed
     */
    public function getCategories(array $params)
    {
        $name = $params['name'];
        $categories = Category::orderBy('id', 'DESC')
            ->where('parent_id', 0);
        if (!empty($name))
            $categories->where('name', 'like', '%' . $name . '%');
        return $categories->paginate(20);
    }

    /**
     * @param string $alias
     * @return mixed
     * @throws Exception
     */
    public function findCategoryAlias(string $alias)
    {
        $category = Category::where('alias', $alias)
            ->first();
        if (empty($category))
            throw new Exception(trans('error.noObject'));
        return $category;
    }
}
