<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;


class PasswordController extends Controller
{
    public function forgetPassword(Request $request){
         $email = $request->email;

         $user= User::where('email',$email)->first();

         if(!$user){
            return response()->json([
                'status'=> 'error',
                'message'=> 'forget Password entry now'
            ],Response::HTTP_NOT_FOUND);
         }

         //generate random token

         $token = Str::random(60);

         //insert the token into password_reset_tokens

         DB::table('password_reset_tokens')->updateOrInsert(
            ['email'=> $email],
            [
                'email' =>$email,
                'token' =>Hash::make($token),
                'created_at' => Carbon::now()
            ]
         );
    }
}
