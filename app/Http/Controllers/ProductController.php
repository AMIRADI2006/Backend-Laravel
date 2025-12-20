<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreValidation;
use App\Models\Product;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $request = Product::all(); // همه فیلدها رو می‌گیره
        return response()->json(['data' => $request]);
    }

    public function store(ProductStoreValidation $request)
    {
//        $product = Product::create($request->except('image_url'));
//        $image_url = Storage::putFile('/googooli', $request->image_url);
//        $product->update(['image_url' => $image_url]);

        $Product = Product::create($request->all());
        return response()->json([
            'message' => 'create product has been successfully !',
            'data' => $Product
        ]);
    }

    public function show(Product $product)
    {
        return response()->json([
            'message' => 'product has been fetch',
            'data' => $product
        ]);
    }

    public function update(Product $product, ProductStoreValidation $request)
    {
        $product->update($request->all());

        return response()->json([
            'message' => 'update product has been successfully',
            'data' => $product
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'delete product has been successfully'
        ]);
    }
}
