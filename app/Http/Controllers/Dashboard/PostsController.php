<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Trait\UploadImage;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostsController extends Controller
{
    use UploadImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('view-any', Post::class);

        $posts = Post::get();
        return view('dashboard.posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', Post::class);
        
        $post = new Post();
        $categories = Category::all();
        if (count($categories)>0) {
            return view('dashboard.posts.create', compact('categories', 'post'));
        }
        return redirect()->route('dashboard.categories.create')->with('danger', __('words.create_category_before'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Post::class);

        $post = Post::create($request->post());
        $post->update(['user_id' => auth()->user()->id]);
        if ($request->has('image')) {
           $post->update(['image'=>$this->upload($request->image)]);
        }
       return redirect()->route('dashboard.posts.index')->with('success', __('words.success_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = Category::all();
        return view('dashboard.posts.edit' , compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update($request->except('image','_token'));
        $post->update(['user_id' => auth()->user()->id]);
        if ($request->has('image')) {
            $post->update(['image'=>$this->upload($request->image)]);
         }
       return redirect()->route('dashboard.posts.edit' , $post)->with('success', __('words.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function delete (Request $request)
    {
       $post = Post::find($request->id);
       $this->authorize('delete', $post);

        if (!empty($post)) {
            $post->delete();
        return Redirect::route('dashboard.posts.index')
            ->with('success', __('words.success_delete'));
        } 
        return Redirect::route('dashboard.posts.index')
            ->with('danger', __('words.success_error'));
    }
}
