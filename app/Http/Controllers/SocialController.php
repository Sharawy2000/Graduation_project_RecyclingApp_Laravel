<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class SocialController extends Controller
{
    public function redirect_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        try{
            $user = Socialite::driver('facebook')->user();
            // $user contains user details, you can now store it in the database or use it as needed.
            $find_user = User::where('social_id', $user->id)->first();

            if($find_user){
                User::where('social_type', ['Google','Facebook'])->update(['status' => 1, 'email_verified_at' => now()]);

                response_data($find_user,'Logged in');
            } else{
                $new_user=User::create([
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'social_id'=>$user->id,
                    'social_type'=>'Facebook',
                    'status'=>1,
                    'password'=>Hash::make('my_facebook')
                ]);
                $new_user['status']=1;
                response_data($new_user,'Logged in',);

            }

        }catch (\Exception $e){
//            dd($e->getMessage());
        }
    }

    public function redirect_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback_google()
    {
        try{
            $user = Socialite::driver('google')->user();
            // $user contains user details, you can now store it in the database or use it as needed.
            $find_user = User::where('social_id', $user->id)->first();

            if($find_user){

                User::where('social_type', ['Google','Facebook'])->update(['status' => 1, 'email_verified_at' => now()]);

                return response_data($find_user,'Logged in');

            } 
            else{
                $new_user=User::create([
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'social_id'=>$user->id,
                    'social_type'=>'Google',
                    'status'=>1,
                    'password'=>Hash::make('my_google')
                ]);

                return response_data($new_user,'Logged in',);
            }

        }catch (\Exception $e){
//            dd($e->getMessage());
        }
    }
}