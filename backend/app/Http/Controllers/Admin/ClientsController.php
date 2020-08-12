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


class ClientsController extends Controller
{
     public function index()
    {
        abort_unless(\Gate::allows('client_access'), 403);

        // $users = User::all();
        $users = DB::table('users')
        ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
        ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')->where('role_id', '3')
        ->where('users.deleted_at', NULL)
        ->select('users.id as id', 'users.name as name', 'users.status as status', 'users.email as email','roles.title as title')
        ->get();

         // $users =User::whereHas('roles', function($q){
         //        $q->where('title', 'Client');
         //    })->get();

        return view('admin.clients.index', compact('users'));
    }
    
     public function active_deactive(){
        $user_id = $_POST['user_id'];
        $check = $_POST['check'];
        $update = DB::update('update users set status = ? where id = ?',[$check,$user_id]);
        if($check == 0)
        {
            echo 'deactivated';
        }else
        {
            echo 'activated';
        }
        

    }

     public function create()
    {
        abort_unless(\Gate::allows('client_create'), 403);

        $roles = Role::all()->pluck('title', 'id');

        return view('admin.clients.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        abort_unless(\Gate::allows('client_create'), 403);

        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.clients.index');
    }

    public function edit($id)
    {
        abort_unless(\Gate::allows('client_edit'), 403);

        $user = User::find($id);
        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');

        return view('admin.clients.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        abort_unless(\Gate::allows('client_edit'), 403);
        $user = User::find($id);
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.clients.index');
    }

    public function show($id)
    {
        abort_unless(\Gate::allows('client_show'), 403);

        $user = User::find($id);
        $user->load('roles');

        return view('admin.clients.show', compact('user'));
    }

    public function destroy($id)
    {
        abort_unless(\Gate::allows('client_delete'), 403);

        $user = User::find($id)->delete();
        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
