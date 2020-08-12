<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Product;

class ProductsApiController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return $products;
    }

    public function store(StoreProductRequest $request)
    {
        return Product::create($request->all());
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        return $product->update($request->all());
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function destroy(Product $product)
    {
        return $product->delete();
    }

    // public function destroy($id)
    // {
    //     $product = auth()->user()->products()->find($id);
 
    //     if (!$product) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Product with id ' . $id . ' not found'
    //         ], 400);
    //     }
 
    //     if ($product->delete()) {
    //         return response()->json([
    //             'success' => true
    //         ]);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Product could not be deleted'
    //         ], 500);
    //     }
    // }
}
