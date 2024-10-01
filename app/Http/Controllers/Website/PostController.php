<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $categories = Category::with('children')->where('parent' , null)->get();
        $lastFivePosts = Post::with('category','user')->orderBy('id')->limit(5)->get();

       return view('website.post' , compact('post', 'categories', 'lastFivePosts'));
    }
}
