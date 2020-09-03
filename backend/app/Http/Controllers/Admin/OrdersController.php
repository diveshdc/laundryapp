<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use Validator;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('order_access'), 403);
    // $orders= Order::all();
           // $orders = Order::where('is_skip_items',0)->get();
           $orders = Order::OrderBy('id','Desc')->with('userInfo')->get();
            // $drivers = User::whereHas('roles',function($q){
            //     $q->where('title', 'Driver')->select('id','first_name','last_name')->get();

                $drivers =User::whereHas('roles', function($q){
                 $q->where('title', 'Driver');
             })->select('id','first_name','last_name')->get();

                
         return view('admin.orders.index',compact(['orders','drivers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // abort_unless(\Gate::allows('order_create'), 403);
        return view('admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try{
        // dd($request);
        abort_unless(\Gate::allows('order_create'), 403);
            $order = Order::create([
            'order_date'   => '2020-01-14',
            'user_id'      => 12,
            'order_status' =>$request->order_status,
            'ship_to'      =>$request->ship_to,
            'order_total'  =>$request->order_total,
            'type'         => 'skip',
        ]);
        $order->save();
            if($order->id){
            return redirect()->route('admin.order.index');
            }else{
                return Redirect::back()->withErrors(['msg', 'somthing went Wrong please try again.']);
            }
        }catch (\Exception $ex){
            return response()->json([
                'status' => 'error',
                'message' => 'Error : '.$ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        abort_unless(\Gate::allows('order_show'), 403);
        // $order = Order::where('id','=',$id)->first();
        $order = Order::where('id',$id)->with('userInfo','productList')->get();
        // dd($order);
        $ipAddress = $request->ip();
        return view('admin.orders.show',compact('order','ipAddress'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // abort_unless(\Gate::allows('order_edit'), 403);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // abort_unless(\Gate::allows('order_edit'), 403);
        //
    }

/**
     * Assign a job to the driver.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

public function assignJob(Request $request) {
  try{
    $validator = Validator::make($request->all(), [
            // 'assign_delivery' => 'bail|required',
            'admin_notes'=>'required',
        ],[
            // 'assign_delivery.required' => 'Driver Id missing'
        ]);
    if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
    }
    if($request['assign_delivery']){
    $aa = Order::where('id',$request['job_id'])->update([
                'assign_to_delivery' =>$request['assign_delivery'],
                'notes' =>$request['admin_notes'],
                'accept_reject'=>'Assigned'
            ]);   
            dd($aa);     
    }
    if($request['assign_collection']){
    Order::where('id',$request['job_id'])->update([
                'assign_to' =>$request['assign_collection'],
                'notes' =>$request['admin_notes'],
                'accept_reject'=>'Assigned'
            ]);
}
    return redirect()->back()->with('success', 'Job assigned successfully!');   
  }catch (\Exception $ex){
            return response()->json([
                'status' => 'errors',
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }

}

    public function skipOrders(){
        $orders = Order::where('is_skip_items',1)->get();
        return view('admin.orders.skiporder',compact('orders'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // abort_unless(\Gate::allows('order_delete'), 403);
        //
    }
}
