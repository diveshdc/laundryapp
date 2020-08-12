<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;

class CheckEmailController extends Controller
{
    public function checkEmail(Request $request)
    {

        if (User::where('email', '=', $request->email)->exists()) {
            return response()->json(array("exists" => true));
        } else {
            return response()->json(array("exists" => false));
        }
    }
}
