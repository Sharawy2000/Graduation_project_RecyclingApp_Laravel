<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function getLogin(){
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])){
            $admin = auth()->guard('admin')->user();
            // if($user->is_admin == 1){
            return redirect()->route('dashboard')->with('success','You are Logged in sucessfully.');
            // }
        }else {
            return back()->with('error','Whoops! invalid email and password.');
        }
    }

    public function adminLogout(Request $request)
    {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');
        return redirect(route('adminLogin'));
    }
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'password' => 'required|string|confirmed|min:6',
            'email' => 'required|string|email|max:100|unique:admins',
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $admin = Admin::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'Successfully registered',
            'admin' => $admin
        ], 201);
        
    }
}
