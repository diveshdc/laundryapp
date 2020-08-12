<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('user_edit');
    }

    public function rules()
    {

        switch ($this->method()) {
        case 'PUT':
        case 'PATCH':
        {
            return [
                'first_name'   => 'required|regex:/^[a-zA-Z]+$/u|max:255',
                'last_name'    => 'required|regex:/^[a-zA-Z]+$/u|max:255',
                // 'email'        => "unique:users,email,$this->id,id",
                'phone_number' => 'required',
                'password'     =>   'required',
                'roles.*'      => ['integer',],
                'roles'        => ['required','array',],
            ];
        }
        default: break;
    }

        // return [
        //     'name'    => [
        //         'required',
        //     ],
        //     'email'   => [
        //         'required',
        //     ],
        //     'password'   => [
        //         'required',
        //     ],
        //     'roles.*' => [
        //         'integer',
        //     ],
        //     'roles'   => [
        //         'required',
        //         'array',
        //     ],
        // ];
    }
}
