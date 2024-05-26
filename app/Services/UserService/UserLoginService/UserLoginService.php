<?php

namespace App\Services\UserService\UserLoginService;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserLoginService{

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
    function getStatus($email) {

        $user=$this->model->where('email',$email)->get();
        $status=$user[0]->status;
        return $status;
    }

    function createNewToken($token){

        return response_data(data: ['access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()],
//            'user' => response_data(new UserResource(auth()->user()))],

            message: __('auth.successLogin'));
    }

    function Login($request) {
        
        $data=$this->Validation($request);

        if (! $token = auth()->attempt($data->validated())) {

            return response_data("",__('auth.failed'),401);
        }

        if($this->getStatus($request->email)==0){
            return response_data("",__('auth.pending'),422);
        };


        return $this->createNewToken($token);
        
    }


}