<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('view-any', Category::class);
        $categories = Category::get();
        return view('dashboard.categories.index',['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Category::class);

        $category = new Category();
        $categories = Category::whereNull('parent')->get();
        return view('dashboard.categories.create', compact('category', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $validatedData)
    {
        $this->authorize('create', Category::class);
        foreach (config('app.languages') as $key => $language) {
            $cc = [
                "title" => $validatedData[$key]['title'],
                "content" => $validatedData[$key]['content'],
                "slug" => str::slug($validatedData[$key]['title'])
            ];
            $validatedData->merge([
                $key =>  $cc,
            ]);
        }

        $category =  Category::create($validatedData->post());
        if ($validatedData->file('image')) {
            $file = $validatedData->file('image');
            $filename = Str::uuid() . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $path = 'images/' . $filename;
            $category->update(['image' => $path]);
        }
        $category->update(['slug' => Str::slug($category->title)]);
        return redirect()->route('dashboard.categories.index')->with('success', __('words.success_create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('update', $category);

        $categories = Category::whereNull('parent')->where('id', '<>', $category->id)->get();
        return view('dashboard.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $validatedData, Category $category)
    {
        $this->authorize('update', $category);

        $category->update($validatedData->post());
        if ($validatedData->file('image')) {
            $file = $validatedData->file('image');
            $filename = Str::uuid() . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $path = 'images/' . $filename;

            $category->update(['image' => $path]);
        }
        return redirect()->route('dashboard.categories.index')->with('success', __('words.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete(Request $request)
    {
        $category = Category::find($request->id);
        $this->authorize('delete', $category);

        if (!empty($category)) {
            $category->delete();
            Category::where('parent', $category->id)->delete();
        return Redirect::route('dashboard.categories.index')
            ->with('success', __('words.success_delete'));
        } 
        return Redirect::route('dashboard.categories.index')
            ->with('danger', __('words.success_error'));
    }
}
