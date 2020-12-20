<?php

namespace App\Http\Controllers;

use App\Exceptions\CoreError;
use App\Http\Resources\CoreResponse;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
class AuthController extends Controller
{
    public function login(Request $request){
        $this->validateAPI($request,[
            'email' => 'required|string|email',
            'password'=>'required|string'
        ]);

        $credentials=request()->only('email','password');
        if(!Auth::attempt($credentials)){
            throw new CoreError('No autorizado para acceder al sistema',401);
        }
        $user=$request->user();
        $tokenResult=$user->createToken('Personal Access Token');
        $token=$tokenResult->token;
        $token->expires_at=now()->addWeeks(1);
        $token->save();
        return new CoreResponse(
            [
                'user'=>$user,
                'access_token'=>$tokenResult->accessToken,
                'token_type'=>'Bearer',
                'expires_at'=>Carbon::parse($token->expires_at)
            ]
        );
    }

    public function logout(Request $request){
        optional(optional($request->user())->token())->revoke();
        return new CoreResponse([
            'message'=>'LOGOUT OK'
        ]);
    }

    public function signup(Request $request){
        $this->validateAPI($request,[
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password'=>'required|string|min:6'
        ]);

        User::create([
           'name'=>$request->name,
           'email'=>$request->email,
           'password'=>bcrypt($request->password),
        ]);

        return new CoreResponse(['REGISTRO OK']);


    }
}
