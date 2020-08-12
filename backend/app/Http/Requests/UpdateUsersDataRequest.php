<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'post_code'        =>['required'],
                    'building_name_no' => ['required',],
                    'street'           => ['required',],
                    'town'             => ['required',],
                    'first_name'       => 'required',
                    'last_name'        => 'required|regex:/^[a-zA-Z]+$/u|max:255',
                    'email'            => 'required|email|unique:users',
                    'password'         => ['required',],
                    'phone_number'     => 'required',

                ];
            }
            default:
                break;
        }
    }
}
