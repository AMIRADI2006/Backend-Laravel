<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreValidation;
use App\Models\Category;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    //

    public function store(CategoryStoreValidation $categoryStoreValidation)
    {
        $Category = Category::create($categoryStoreValidation->all());
        return response()->json([
            'message' => 'create category has been successfully !',
            'data' => $Category
        ]);
    }

    public function show(Category $category)
    {
        return response()->json([
            'message'=> 'admin has been fetch',
            'data'=> $category
        ]);
    }

    public function update(Category $category , CategoryStoreValidation $categoryStoreValidation)
    {
        $category->update(\request()->all());
        $category = Category::find($category->id);
        return response()->json([
            'message' => 'update category has been successfully',
            'data' => $category
        ]);
    }

    public function delete(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'delete category has been successfully'
        ]);
    }

}
