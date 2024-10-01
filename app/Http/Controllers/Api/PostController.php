<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clear_data = $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
        ]);
        // $validate = Validator::make($request->all(), [
        //     'category_id' => 'required|integer|exists:categories,id',
        //     'number' => 'required|numeric',
        // ]);
        // if($validate->fails()){
        //     return response()->json(['data' => $validate->getMessageBag()],406);
        // }

        $posts = Post::with('category')->where('category_id', $clear_data['category_id'])->paginate(1);
        return PostResource::collection($posts);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::where('id', $id)->with('category')->firstOrFail();
        return PostResource::make($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
