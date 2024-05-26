<?php

namespace App\Services\UserService\UserRegisterService;

use App\Mail\VerificationEmail;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class UserRegisterService{

    protected $model;

    function __construct(){
        $this->model=new User ;
    }

    function Validation($request) {

        $validator=Validator::make($request->all(),$request->rules());
        if ($validator->fails()) {
            return response_data("",$validator->errors(),422);
        }
        return $validator;
    }

    function GenerateToken($email){
        $token=substr(md5(rand(0,9). $email . time()),0,32);
        $user=$this->model::where('email',$email)->get();
        $user[0]->verificationToken=$token;
        $user[0]->save();
        return $user;
    }

    function Store($data,$request){
        $user = User::create(array_merge(
            $data->validated(),
            ['password' => bcrypt($request->password)
            ]
        ));
        return $user->email;
    }

    function SendMail($user){
        $user_info=$user[0];
        Mail::to($user_info->email)->send(new VerificationEmail($user_info));
//        dd($user_info->email);
    }

    function Register($request) {
        try {
            DB::beginTransaction();
            $data=$this->Validation($request);
            $email=$this->Store($data,$request);
            $user=$this->GenerateToken($email);
            $this->SendMail($user);

            DB::commit();
            
            return response_data("",__("auth.created"));

        } catch (Exception $e) {
            DB::rollBack();
        }

    }


}


