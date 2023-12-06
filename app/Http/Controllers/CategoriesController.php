<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;
    

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        // return $posts;
        return CategoryResource::collection($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        // return new CategoryResource(true, 'Data Post Berhasil Ditambahkan!', $category);

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->name = $request->input('name');
        $category->slug = SlugService::createSlug(Category::class, 'slug', $request->input('name'));
        $category->save();

        return response()->json(['message' => 'Category updated successfully', 'data' => new CategoryResource($category)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
    
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    
        $category->delete();
    
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
