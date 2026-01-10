<?php

namespace App\Services\Auth;

use App\Models\User;
use Symfony\Component\HttpFoundation\Request;

class AuthServices
{
    public function created($request){
 $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> $request->password,
        ]);

        $token= auth()->login($user);

        return response()->json([
            'status'=>'error',
            'message'=> 'validator error',
            'data' => [
                'user'=> $user,
                'access_token' => $token,
                'token-type'=> 'bearer',
                'expires' => auth()->factory()->getTTL() *60
            ],
        ]);
    }
}
