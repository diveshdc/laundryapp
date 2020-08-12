<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('product_create');
    }

    public function rules()
    {
        return [
        'name' => ['required',],
        'price' => ['required',],
        'description' => ['required',],
        'image' => ['required',],
        'category.*' => ['integer','required'],
        ];
    }

    public function withValidator($validator){
    if($validator->fails()){
        $validator->after(function ($validator){
            $array = [];
            if($validator->fails()){
                 foreach ($validator->messages()->getMessages() as $field_name => $errors){
                    $array[$field_name][] = $errors;
                   dd($array);

            }
            echo json_encode(['errors' => $array ]);
            return;
        }
            }
        });
    }
}
