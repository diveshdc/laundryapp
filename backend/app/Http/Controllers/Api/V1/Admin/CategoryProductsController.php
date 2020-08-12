<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\CartItem;
use DB;
class CategoryProductsController extends Controller
{ 
   public function getCategoryList(Request $request){
   	try{

   		// abort_unless(\Gate::allows('product_access'), 403);
      // $productsList = Category::with('category_product')->get();
      // dd( $request['user_id']);
      if(empty($id)){
        $productsList = Category::get();
        foreach ($productsList as $key => $value) {
          $value['category_product'] = $value->category_product()->paginate(5);
          if(count($value['category_product'])>0){
            foreach ($value['category_product'] as $key => $product_value) {
              $product_value['category_id'] = $value['id'];
            }
          }
        }
        $items = CartItem::where('user_id',$request['user_id'])->select('product_id','quantity','category_id')->get();
        // dd($items);
      }else{
        $productsList = Category::where('id', $id)->first();
        $productsList['category_product'] = $productsList->category_product()->paginate(5);
           if(count($productsList['category_product'])>0){
            foreach ($productsList['category_product'] as $key => $product_value) {
              $product_value['category_id'] = $id;
            }
          }
      }
      
  		// $productsList = Category::with('category_product.products')->get();
   		return response()->json([
   			'status'             => true, 
   			'message'            => 'Category and products found',
   			'categoriesArray'    => $productsList,
        'quantity_count'     =>$items
   		],200);
   	}catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        } 
   }

    public function searchProducts(Request $request){
    try{
      // abort_unless(\Gate::allows('product_access'), 403);
       $q = $request->name;

       $productsList = Product::with('product_category')->where('name', 'like', "%{$q}%")->get();


       // $productsList = Product::where('name', 'like', "%{$q}%")->get();
       //  foreach ($productsList as $key => $value) {
       //    $value['product_category'] = $value->product_category()->get();
       //    if(count($value['product_category'])>0){
       //      foreach ($value['product_category'] as $key => $product_value) {
       //        $productsList['category_id'] = $value['id'];
       //      }
       //    }
       //  }



       if(count($productsList) > 0){
      return response()->json([
        'status'  => true, 
        'message' => 'Products found',
        'productList'    => $productsList
      ],200);
    }else{
      return response()->json([
        'status'  => false, 
        'message' => 'Products not found',
      ],200);
    }
    }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        } 
   }

    public function getProductListByCatId(Request $request){
    try{
      // abort_unless(\Gate::allows('product_access'), 403);
      $productsList = Product::with('category_product')->find('1');
      return response()->json([
        'status'  => true, 
        'message' => 'Category and products found',
        'categoriesArray'    => $productsList
      ],200);
    }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        } 
   }
}
