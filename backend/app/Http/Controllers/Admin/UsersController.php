<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\DB;
use App\Notifications\NotifyToUserAccountCreation;
use App\Exception;
use App\Role;
use App\User;
use Hash;
use Mail;
use App\Mail\SendCredentials;

class UsersController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('user_access'), 403);
            $users = User::whereHas('roles',function($q){
                $q->where('title', 'User');
            })->get();
        // $users = Role::where('title', 'User')->first()->users()->get();
        return view('admin.users.index', compact('users'));
    }

    public function changeStatus (Request $request){
         $first_name = User::where('id',$request->user_id)->pluck('first_name')->first();
         $gen_pass = '12345';
          $user = User::where('id', $request->user_id)->update([
                        'is_request' => $request->status,
                        'password' => bcrypt($first_name.$gen_pass),
                    ]);
          if($user){
                $data = User::where('id',$request->user_id)->first();
                $sent = Mail::to($data->email)->send(new SendCredentials($data));
                return response()->json([
                    'success'=>'Driver activated successfully.',
                    'url'    =>''
                ]);
          }
    }

    public function create()
    {
        abort_unless(\Gate::allows('user_create'), 403);

        $roles = Role::all()->pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        try{
        abort_unless(\Gate::allows('user_create'), 403);
        $referrerCode = 3;
        $user = User::create([
            'first_name'       =>$request->first_name,
            'last_name'        =>$request->last_name,
            'email'            =>$request->email,
            'phone_number'     =>$request->phone_number,
            'building_name_no' =>$request->building_name_no,
            'street_name'      =>$request->street_name,
            'town'             =>$request->town,
            'post_code'        =>$request->post_code,
            'town'             =>$request->town,
            'reference_from'   =>$request->reference_from,
            'password'         =>Hash::make($request->pasword),
            'referrer_code'    =>$request->first_name.strtoupper(substr(md5(time()), 0,$referrerCode))
        ]);
        $user->save();
        $user->roles()->sync($request->input('roles', []));
        if($user->id && $request->send_mail){
            $user = new User();
            $user->email = $request->email;// This is the email you want to send to.
            $user->name = $request->first_name;

            $user->notify(new NotifyToUserAccountCreation($user));
        }
        return redirect()->route('admin.users.index');

    }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        }
    }

    public function edit(User $user)
    {
        abort_unless(\Gate::allows('user_edit'), 403);
        $roles = Role::all()->pluck('title', 'id');
        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        abort_unless(\Gate::allows('user_edit'), 403);

        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_unless(\Gate::allows('user_show'), 403);
        $user->load('roles');
        return view('admin.users.show', compact('user'));
    }
    public function destroy(User $user)
    {
        abort_unless(\Gate::allows('user_delete'), 403);

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }

    public function checkEmailIsAlready(Request $request){
            $email = $request->email;
            $isExists = \App\User::where('email',$email)->first();
            if($isExists){
                return response()->json(array("exists" => true));
            }else{
                return response()->json(array("exists" => false));
            }
}

}
