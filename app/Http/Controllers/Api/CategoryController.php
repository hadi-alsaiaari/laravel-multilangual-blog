<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::paginate(2);
        return CategoryResource::collection($categories);
    }

    public function navbarCategories()
    {
        $categories = Category::with('children')->where('parent' , null)->get();
        
        $categories = CategoryResource::collection($categories);
        return response()->json(['data' => $categories, 'error' => ''], 200);
    }

    public function indexPageCategoriesWithPosts()
    {
        $categories_with_posts = Category::with(['posts'=>function ($q){
            $q->with('user')->limit(5);
        }])->get();

        $categories_with_posts = CategoryResource::collection($categories_with_posts);
        return response()->json(['data' => $categories_with_posts, 'error' => ''], 200);
    }

    public function show($id) {
        $category = Category::findOrFail($id);
        return CategoryResource::make($category);
    }
}
