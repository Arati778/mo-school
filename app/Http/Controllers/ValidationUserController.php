<?php

namespace App\Http\Controllers;

use App\Models\Validation_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidationUserController extends Controller
{
    public function validateOtp(Request $request)
    {
        
      $validator =  Validator::make($request->all(),[
               'email'=> 'required|email',
                'otp'=> 'required|string|min:6|max:6',
        ]);

        if ($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()],400);
        }

        $validationUser = Validation_user::where('email', $request->email)
        ->where('otp', $request->otp)
        ->first();

        if(!$validationUser){
            return response()->json(['error'=> 'invalid otp'],400);
        }
    

        return response()->json(['message' => 'OTP validated successfully']);
    }
}
