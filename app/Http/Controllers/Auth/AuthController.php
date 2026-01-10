<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\User;
use App\Services\Auth\AuthServices;
use Doctrine\Common\Lexer\Token;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{

    public function __construct(private AuthServices $auth_services)
    {
        throw new \Exception('Not implemented');
    }

    public function register(RegistrationRequest $request){

      return $this->auth_services->created($request);
    }

    public function login(LoginRequest $request){
        $credentials= $request->only('email','password');

        if(!$token = auth()->attempt($credentials)){
             return response()->json([
            'status'=>'error',
            'message'=> 'credentials was invalid',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

         return response()->json([
            'status'=>'error',
            'message'=> 'validator error',
            'data' => [
                'user'=> auth()->$user(),
                'access_token' => $token,
                'token-type'=> 'bearer',
                'expires' => auth()->factory()->getTTL() *60
            ],
        ]);
    }
}
