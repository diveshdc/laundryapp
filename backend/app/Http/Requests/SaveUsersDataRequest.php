<?php

namespace App\Http\Requests;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class SaveUsersDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'building_name_no'   => 'required',
                    'street'              => 'required',
                    'town'               => 'required',
                    'first_name'         => 'required', 
                    'last_name'          => 'required', 
                    'post_code'          => 'required',
                    'reference_from'     => 'required',
                    'email'              => 'required|unique:users,email', 
                    'password'           => 'required|min:6|confirmed',
                    'phone_number'       => ['required'],//'digits:15'

                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'first_name' => 'required|regex:/^[a-zA-Z]+$/u|max:255',
                    'last_name' => 'required|regex:/^[a-zA-Z]+$/u|max:255',
                    'email' => "unique:users,email,$this->id,id",
                ];
            }
            default:
                break;
        }
    }
}
