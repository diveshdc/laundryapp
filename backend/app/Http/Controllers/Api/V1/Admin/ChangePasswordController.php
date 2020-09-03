<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Rules\MatchOldPassword;
// use Illuminate\Support\Facades\Hash;
use App\User;
use Hash;
use Auth;
use Validator;
use Exception;
use App\Mail\ChangePassword;
use Mail;

class ChangePasswordController extends Controller
{
 
 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    
 function ChangePassword(Request $request) {
    try{ 
            $validator = Validator::make($request->all(), [
                'current_password' => 'bail|required',
                'password'         => 'bail|required|min:6|confirmed',
                'user_id' => 'bail|required',
            ]);
            $new_password = $request->password;
          if ($validator->fails()) {
                foreach ($validator->messages()->getMessages() as $field_name => $messages){

                     return response()->json([
                        'status'  => false,
                        'message' => implode('<br/>', $messages)
                    ], 401); 
                }
            } 
            $user = User::where('id', $request->user_id)->first();
            if(!$user == null){
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'Current password does not match'
                ], 200);
            }
            $user->password = Hash::make($new_password);
            $user->save();
             $sent = Mail::to($user['email'])->send(new ChangePassword($user));
            if ($user) {
                return response()->json([
                    'status' => true,
                    'message' => 'Password has been successfully updated!'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong, not able to update password, try again!'
                ], 200);
            }
        }else{
            return response()->json([
                    'status' => false,
                    'message' => 'User not found with this user id!'
                ], 401);
        }
        }catch (\Exception $ex){
            return response()->json([
                'status' => 'error',
                'message' => 'Error : '.$ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        } 

}
}
