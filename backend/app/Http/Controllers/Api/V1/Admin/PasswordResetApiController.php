<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\PasswordResetRequest;
// use App\Notifications\PasswordResetSuccess;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\User;
use App\PasswordReset;
use Validator;
use Mail;
use App\Mail\ResetPassword;
use App\Mail\PasswordResetSuccess;


class PasswordResetApiController extends Controller
{

    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function checkEmailAndSendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'status'  => false,
                'message' => "We can't find a user with that e-mail address."
            ]);
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(60)
             ]
        );
        if ($user && $passwordReset){
            // $user->notify(new PasswordResetRequest($passwordReset->token, $user));
              $sent = Mail::to($user->email)->send(new ResetPassword($passwordReset->token, $user));

            return response()->json([
                'status' => true,
            'message'    => 'We have e-mailed your password reset link!'
        ],200);
    }else{
        return response()->json([
            'status'  =>false,
            'message' => 'Internal server error!'
        ],500);
    }
    }

    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token)
    {
        try{
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        }
        return view('api.resetpassword',compact('passwordReset'));
    }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        } 
    }
     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(Request $request)
    {
        try{
        $validator = Validator::make($request->all(), [ 
            'password' => 'required|confirmed',
            'token' => 'required|string'
        ]);
        if ($validator->fails()) {
            foreach ($validator->messages()->getMessages() as $field_name => $messages){
                echo implode('<br />', $messages);
                return;
            }
            }
        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();
        if (!$passwordReset){
                 echo 'This password reset token is invalid.';
                 exit();
        }
        $user = User::where('email', $passwordReset->email)->first();
        if(empty($user)){
        echo "We can't find a user with that e-mail address.";
        exit();
        }
        $user->password = bcrypt($request->password);
        $user->update();
        $passwordReset->delete();
          $sent = Mail::to($user->email)->send(new PasswordResetSuccess($user));
        // $user->notify(new PasswordResetSuccess($passwordReset));

        echo 'password reset successfully!';
         exit();
     }catch (\Exception $ex){
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage(),
                'error_details' => 'on line : '.$ex->getLine().' on file : '.$ex->getFile(),
            ], 200);
        } 
    }
}
