<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $categories = Category::with('children')->where('parent' , null)->get();
        $lastFivePosts = Post::with('category','user')->orderBy('id')->limit(5)->get();

        $category = $category->load('children');
        $posts = Post::where('category_id' , $category->id)->paginate(1);
        
        return view('website.category' , compact('category','posts', 'categories','lastFivePosts'));
    }
}
