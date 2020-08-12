<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('user_create');
    }

    public function rules()
    {
        switch ($this->method()) {
        case 'POST':
        {
            return [
                'first_name'    => 'required',
                'last_name'     => 'required|regex:/^[a-zA-Z]+$/u|max:255',
                'email'         => 'required|email|unique:users',
                'phone_number'  => 'required',
                'password'      => ['required',],
                'roles.*'       => ['integer',],
                'roles'         => ['required','array',],
            ];
        }
        case 'PUT':
        case 'PATCH':
        {
            return [
                'first_name'   => 'required|regex:/^[a-zA-Z]+$/u|max:255',
                'last_name'    => 'required|regex:/^[a-zA-Z]+$/u|max:255',
                'email'        => "unique:users,email,$this->id,id",
            ];
        }
        default: break;
    }












        // return [
        //     'name'     => [
        //         'required',
        //     ],
        //     'email'    => 
        //     ['required|email|unique:users'
        // ],
        //     'password' => [
        //         'required',
        //     ],
        //     'roles.*'  => [
        //         'integer',
        //     ],
        //     'roles'    => [
        //         'required',
        //         'array',
        //     ],
        // ];
    }
}
