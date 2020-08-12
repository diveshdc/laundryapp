<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use View;

class ProductCategoryController extends Controller
{
  
   public function priceList(){
        $categories = Category::select('id', 'name','image')->get();
        $categories_product = Category::with('category_product')->first();
        return view('userinterface.price-list',compact('categories'));
    }
   public function getProductByCatId($categoryId=null) {
      $products = Category::where('id', $categoryId)->first();
        $products = $products->category_product()->paginate(4);
        $returnHTML = view('userinterface.product_list_ajax')->with('products', $products)->render();
        if($products){
        return response()->json(array('status' => true, 'html'=>$returnHTML));
        }else{
          return response()->json(['status' => false]);
        }
    }

    public function getProducts(Request $request){
        $categories = Category::select('id', 'name','image')->get();
        $first_categories = Category::select('id', 'name','image')->first();
        $categories_product = $first_categories->category_product()->paginate(4);
        return view('userinterface.product_basket',compact(['categories','categories_product'])); 
    }

}
