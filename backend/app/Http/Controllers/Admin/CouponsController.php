<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\MassDestroyCouponRequest;
use Illuminate\Http\Request;
use App\Coupon;
use App\Product;    
use App\Category;
use Carbon\Carbon;
use App\CouponProductsCategory;
class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('coupon_access'), 403);
        $coupons = Coupon::all();
        return view('admin.coupons.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      abort_unless(\Gate::allows('coupon_create'), 403);
        $product = Product::all()->pluck('name','id');
        $category =Category::all()->pluck('name','id');              
        return view('admin.coupons.create',compact('product','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCouponRequest $request)
    {
        // dd($request);
       abort_unless(\Gate::allows('coupon_create'), 403);
       $expiry_date = date('Y-m-d H:i:s',strtotime($request->expiry_date));

       $couponData = Coupon::create([
                'coupon_code'           => $request->coupon_code,
                'description'           => $request->description,
                'discount_type'         => $request->discount_type,
                'price'                 => $request->price,
                'expiry_date'           => $expiry_date,
                'minimum_spend'         => $request->minimum_spend,
                'maximum_spend'         => $request->maximum_spend,
                'individual_use_only'   => $request->individual_use_only?'1':'0',
                'exclude_sale_item'     => $request->exclude_sale_item?'1':'0',
                'usage_limit_per_coupon'=> $request->usage_limit_per_coupon,
                'limit_usage_x_item'    => $request->limit_usage_x_item,
                'usage_limit_per_user'  => $request->usage_limit_per_user,

        ]);
        $couponData->save();
        if(!empty($couponData)){
               $productArray = $request->product;
               if($productArray){
                foreach($productArray as $selectedProduct){
                    $couponForProduct = CouponProductsCategory::create([
                        'products'   => $selectedProduct
                    ]);
                    $couponForProduct->save();
                }
            }
            $excludeProductsArray = $request->exclude_products;
            if($excludeProductsArray){
                foreach($excludeProductsArray as $selectedExcludeProducts){
                    $newSelectedExcludeProducts=array(
                        'exclude_products' => $selectedExcludeProducts
                    ); 
                    $couponForExcludeProducts = new CouponProductsCategory($newSelectedExcludeProducts);
                    $couponForExcludeProducts-> save();
                }
            }
            $categoriesArray = $request->category;
            if($categoriesArray){
                foreach($categoriesArray as $selectedCategory){
                    $newCategoriesArray=array(
                        'category'   => $selectedCategory
                    );
                    $couponForCategories = new Coupon($newCategoriesArray);
                    $couponForCategories-> save();
                }
            }
            $excludeCategoryArray = $request->exclude_categories;
            if($excludeCategoryArray){
                foreach($excludeCategoryArray as $selectedExcludeCategory){
                    $newCategoriesArray=array(
                        'exclude_categories' => $selectedExcludeCategory
                    );
                    $couponForCategories = new CouponProductsCategory($newCategoriesArray);
                    $couponForCategories-> save();
                }
            }

        }
        // $validatedData = $request->validated();
        // $coupon = Coupon::create($validatedData);
        return redirect()->route('admin.coupons.index');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    abort_unless(\Gate::allows('coupon_show'), 403);

        $coupon = Coupon::find($id);
        return view('admin.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(\Gate::allows('coupon_edit'), 403);
        $product = Product::all()->pluck('name','id');
        $category =Category::all()->pluck('name','id');   
        $coupon = Coupon::find($id);
        return view('admin.coupons.edit', compact('coupon','category','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCouponRequest $request, $id)
    {
       abort_unless(\Gate::allows('coupon_edit'), 403);

        $coupon = Coupon::find($id);
        $coupon->update($request->all());
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(\Gate::allows('coupon_delete'), 403);

        $coupon = Coupon::find($id)->delete();
        return back();
    }


    public function massDestroy(MassDestroyCouponRequest $request)
    {
        Coupon::whereIn('id', request('ids'))->delete();
        return response(null, 204);
    }

 /**
     * change the status of  specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

      public function changeStatus(Request $request){ 
         $data = User::where('id', $request->user_id)
                ->update([
                        'status' => $request->status
                    ]);
        return response()->json(['success'=>'Status change successfully.']);
    }
}
