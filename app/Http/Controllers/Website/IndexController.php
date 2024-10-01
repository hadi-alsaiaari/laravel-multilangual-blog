<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::with('children')->where('parent' , null)->get();
        $lastFivePosts = Post::with('category','user')->orderBy('id')->limit(5)->get();

        $categories_with_posts = Category::with(['posts'=>function ($q){
            $q->limit(2);
        }])->get();
       return view('website.index' , compact('categories_with_posts', 'categories', 'lastFivePosts'));
    }
}
