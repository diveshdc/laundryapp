<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\CartItem;
use App\CategoryProduct;
use Validator;
use Exception;
use DB;
use Image;


class ProductsController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('product_access'), 403);
        $products = Product::with('product_category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('product_create'), 403);
        $category =  Category::all()->pluck('name', 'id');
        return view('admin.products.create', compact('category'));
    }

    public function store(Request $request) 
    {
        try{
            abort_unless(\Gate::allows('product_create'), 403);
        $formInput=$request->except('image');
        $validator = Validator::make($request->all(), [
                'name' => ['required',],
                'price' => ['required',],
                'description' => ['required',],
                'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);
        $image= $request->image;
        if($image){
                $image =$request->file('image');
                $parts = pathinfo($image->getClientOriginalName());
                $extension = strtolower($parts['extension']);
                $imageName = uniqid() . mt_rand(999, 9999) . '.' . $extension;
                $imagePath = '/images/product_images/';
                $img = Image::make($image->path());
                $img->resize(16, 9, function ($constraint) {
                $constraint->aspectRatio();
                })->save(public_path($imagePath.'/'.$imageName));
                $image->move(public_path() .$imagePath ,$imageName);
                $formInput['image'] =  url('/').$imagePath.$imageName;
        }
        $product = Product::create($formInput);
        $product->product_category()->sync($request->input('category', []));
        return redirect()->route('admin.products.index');
    }catch (\Exception $ex){
        return response()->json([
            'status' => 'error',
            'message' => 'Error : '.$ex->getMessage(),
            'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
        ],      200);
    }
}

public function edit(Product $product)
{
    abort_unless(\Gate::allows('product_edit'), 403);
    $category =  Category::all()->pluck('name', 'id');
    // $product = Product::where('id',$productId)->get();
    return view('admin.products.edit', compact('product','category'));
}

public function update(UpdateProductRequest $request, Product $product)
{
    try{
            abort_unless(\Gate::allows('product_edit'), 403);
        $formInput=$request->except('image');
        $validator = Validator::make($request->all(), [
                'name' => ['required',],
                'price' => ['required',],
                'description' => ['required',],
            ]);
        $image=$request->image;
        if($image){
           // $image =$request->file('image');
           //      $parts = pathinfo($image->getClientOriginalName());
           //      $extension = strtolower($parts['extension']);
           //      $imageName = uniqid() . mt_rand(999, 9999) . '.' . $extension;
           //      $imagePath = '/images/product_images/';
           //      $image->move(public_path() .$imagePath ,$imageName);
           //      $formInput['image'] =  url('/').$imagePath.$imageName;
             $image =$request->file('image');
                $parts = pathinfo($image->getClientOriginalName());
                $extension = strtolower($parts['extension']);
                $imageName = uniqid() . mt_rand(999, 9999) . '.' . $extension;
                $imagePath = '/images/product_images/';
                $img = Image::make($image->path());
                $img->resize(16, 9, function ($constraint) {
                $constraint->aspectRatio();
                })->save(public_path($imagePath.'/'.$imageName));
                $image->move(public_path() .$imagePath ,$imageName);
                $formInput['image'] =  url('/').$imagePath.$imageName;
        }
         $product->update($formInput);
         $product = Product::find($product->id);
         $product->product_category()->sync($request->input('category', []));
       
        return redirect()->route('admin.products.index');
    }catch (\Exception $ex){
        return response()->json([
            'status' => 'error',
            'message' => 'Error : '.$ex->getMessage(),
            'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
        ],      200);
    }

    return redirect()->route('admin.products.index');
}

public function show(Product $product)
{
    abort_unless(\Gate::allows('product_show'), 403);
    $products = Product::whereId($product->id)->with('product_category')->get();
    $category = Category::whereId($product->id)->get();
    // dd($products);
    return view('admin.products.show', compact('product','category'));
}

public function destroy(Product $product)
{
    abort_unless(\Gate::allows('product_delete'), 403);

    $product->delete();
    if($product->delete() == true){
        CartItem::where('product_id',$product->id)->delete();
    }
    return back();
}

public function massDestroy(MassDestroyProductRequest $request)
{
    Product::whereIn('id', request('ids'))->delete();

    return response(null, 204);
}

 
}
