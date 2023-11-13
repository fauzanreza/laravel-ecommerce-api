<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Categories;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Categories::paginate(5));
    }

    public function store(Request $request)
    {
        $category_name = $request->input('category_name');

        $category = Categories::create([
            'category_name' => $category_name
        ]);
            return response()->json([
                'data' => new CategoryResource($category)
            ], 201);
    }

    public function show(Categories $category)
    {
    return new CategoryResource($category);
    }

    public function update(Request $request, Categories $category)
    {
        $category_name = $request->input('category_name');

        $category->update([
            'category_name' => $category_name
        ]);
            return response()->json([
                'data' => new CategoryResource($category)
            ], 200);
    }

    public function destroy(Categories $category)
    {
        $category->delete();
        return response()->json(null,204);
     }
}
