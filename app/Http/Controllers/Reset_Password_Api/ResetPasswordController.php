<?php

namespace App\Http\Controllers\Reset_Password_Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCodeResetPassword;

class ResetPasswordController extends Controller
{
    protected $model;

    function __construct(){
        $this->model=new User ;
    }
    public function forget_password(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        // Delete all old code that user send before.
        ResetCodePassword::where('email', $request->email)->delete();

        // Generate random code
        $data['code'] = mt_rand(100000, 999999);

        // Create a new code
        $codeData = ResetCodePassword::create($data);
        $codeData->save();

        // Send email to user
        Mail::to($data['email'])->send(new SendCodeResetPassword($codeData->code));

        return response(['message' => trans('passwords.sent')], 201);
    }

    public function code_validate(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:reset_code_passwords',
        ]);

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }

        return response([
//            'code' => $passwordReset->code,
            'message' => trans('passwords.code_is_valid')
        ], 200);
    }
    public function reset_password(Request $request)
    {

//      // add function
//      // add link to verfiy code , email

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
        ]);



        // find the code
        $passwordReset = ResetCodePassword::firstWhere('email', $request->email);


        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }

        // find user's email
        $user = User::firstWhere('email', $request->email);

        // update user password
        $user->update(['password' => bcrypt($request->password)]);


        // delete current code
        $passwordReset->delete();

        return response(['message' =>'password has been successfully reset'], 200);
    }

}
