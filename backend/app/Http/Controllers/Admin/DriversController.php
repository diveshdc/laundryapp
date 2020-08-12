<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\DB;
use App\Role;
use App\User;
use App\Order;

class DriversController extends Controller
{

   public function index()
    {
        abort_unless(\Gate::allows('driver_access'), 403);

//        $users = User::whereHas(
//            'roles', function($q){
//            $q->where('title', 'Driver');})->get();

//        $users = User::with('roles')->get();
//        dd($users);
//          $users = DB::table('users')
//        	 	 ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
//        	 	 ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
//        	 	 ->where('role_id', '4')
//        	 	 ->where('users.deleted_at', NULL)
//        	 	 ->select('users.id as id', 'users.first_name as first_name',
//                     'users.last_name as last_name','users.vehicle_number as vehicle_number',
//                     'users.phone_number as phone_number',
//        	 	    'users.email as email','roles.title as title')
//        	 	 ->get();
        
         $users =User::whereHas('roles', function($q){
                 $q->where('title', 'Driver');
             })->get();

        return view('admin.drivers.index', compact('users'));
    }

     public function create()
     {
        abort_unless(\Gate::allows('driver_create'), 403);

        $roles = Role::all()->pluck('title', 'id');

        return view('admin.drivers.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        abort_unless(\Gate::allows('driver_create'), 403);
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        return redirect()->route('admin.drivers.index');
    }

    public function edit($id)
    {
        abort_unless(\Gate::allows('driver_edit'), 403);
        $user = User::find($id);
        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');

        return view('admin.drivers.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        abort_unless(\Gate::allows('driver_edit'), 403);
        $user = User::find($id);
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.drivers.index');
    }

    public function show($id)
    {
        abort_unless(\Gate::allows('driver_show'), 403);

        $user = User::find($id);
        $user->load('roles');
        return view('admin.drivers.show', compact('user'));
    }

    public function viewTask($id)
    {
        // abort_unless(\Gate::allows('driver_show'), 403);

        $order = Order::where('assign_to', $id)->with(array('userInfo'=>function($query){
    $query->select('id','first_name','last_name','phone_number');}))->get();
        return view('admin.drivers.viewtask', compact('order'));
    }

     public function showDriverRequest() {
       $driver_request = User::whereHas('roles', function($q){
                $q->where('title', 'Driver')->where('is_request','1');})->get();
         return view('admin.drivers.driver_request', compact('driver_request'));
    }

    public function destroy($id)
    {
        abort_unless(\Gate::allows('driver_delete'), 403);

        $user = User::find($id)->delete();
        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();
        return response(null, 204);
    }

    public function blockUsers(Request $request)
    {
        User::where('id',$request->user_id)->update([
            'blocked'=>$request->status
        ]);
        return response('Successfull!', 200);
    }

}
