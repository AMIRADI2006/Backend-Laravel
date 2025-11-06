<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreValidation;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class  ProductController extends Controller
{
    public function store(ProductStoreValidation $productStoreValidation)
    {
//        فقط برای نمایش هستش مثل کنسول لاگ در جاوا اسکریپت
//        dd($request->name);

//            برای درج محصول در دیتا بیس با مقادیری که از سمت کاربر آمده
//        روش اول
//        Product::create([
//            'name'=>$request->name
//        ]);
//        روش دوم (روش بهتر )


        $Product = Product::create($productStoreValidation->except('image_url'));
        $image_url = Storage::putFile('/products',$productStoreValidation->image_url);
        $Product->update(['image_url' => $image_url]);
        return response()->json([
            'message' => 'create product has been successfully !',
            'data' => $Product
        ]);
    }

    public function show(Product $product)
    {
        return response()->json([
           'message'=> 'product has been fetch',
            'data'=> new ProductResource($product)
        ]);
    }

    public function update(Product $product , ProductStoreValidation $productStoreValidation)
    {
//        برای نمایس
//        dd($product , $request->all());

//        روش اول
//        Product::update([
//            'name' => $request->name
//        ]);

//        روش بهتر
        $product->update(\request()->all());
        $product = Product::find($product->id);
        return response()->json([
            'message' => 'update product has been successfully',
            'data' => $product
        ]);

    }

    public function delete(Product $product)
    {
        $product->delete();
        return response()->json([
           'message' => 'delete product has been successfully'
        ]);
    }
}
