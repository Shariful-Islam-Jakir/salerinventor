<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function forgetPassword(Request $request){
         $email = $request->email;

         $user= User::where('email','$email')->first();

    }
}
