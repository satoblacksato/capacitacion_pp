<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Socialite;
class AuthSocialController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        $info=Socialite::driver($provider)->stateless()->user();
        $user=$this->createUser($info,$provider);
        auth()->login($user);
        return redirect()->to('/');
    }

    public function createUser($info,$provider){
        $user=User::where('provider_id','=',$info->id)->first();
        if(!$user){
            $user=User::create([
               'name'=>$info->name,
               'email'=>$info->email,
               'provider_id'=>$info->id,
                'provider'=>$provider
            ]);
        }
        return $user;
    }
}
