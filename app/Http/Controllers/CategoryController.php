<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Model\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $builder = Category::query();
        $builder->sort('priority', 'desc');
        return $builder->get();
    }

    public function store(CategoryRequest $req) {
        $data = $req->validated();
        return Category::create($data);
    }

    public function update(CategoryRequest $req, Category $category) {
        $data = $req->validated();
        $category->fill($data)->save();
        return $category;
    }

    public function destroy(Category $category) {
        $category->delete();
        return $category;
    }
}
