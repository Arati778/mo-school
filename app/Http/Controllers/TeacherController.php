<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Validation_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function teacher(Request $request)
    {

        $validator =  Validator::make($request->all(),[
            'first_name'=> 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender'=> 'required|string|in:male,female,other',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|string|min:6',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 400);
        }


       $otp = $this->generateOtp(6);
       $user = User::create([
            'name'=> $request->first_name . " " . $request->last_name,
            'email'=>$request->email,
            'password'=>$request->password,
        ]);
        
        if(!$user){
            return response()->json(['error'=>'Failed to create user'],500);
        }

        
        $teacher = Teacher::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender'=> $request->gender,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'subject'=>$request->subject,
            'user_id'=>$user->id
        ]);

        if(!$teacher){
            User::where("id",$user->id)->delete();
            return response()->json(['error'=>'Failed to create Teacher'],500);
        }

     
        Validation_user::create([
            'email'=>$user->email,
            'otp'=>$this->generateOtp(6),
        ]);
        Mail::to($user->email)->send(new WelcomeEmail($otp));
       
        return response()->json(['message'=>'Teacher created successfully', 'data'=> $teacher],201);
    }
    
        private function generateOtp($length = 6)
        {
            $otp = '';
            for ($i = 0; $i < $length; $i++) {
                $otp .= mt_rand(0, 9); 
            }
            return $otp;
        }
     
     /**
     * Show the form for creating a new resource.
     */
    public function getTeacher($id)
    {
        $teacher = Teacher::findOrFail($id);
        return response()->json(['data'=>$teacher]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function updateTeacher(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        info ($teacher);
        $teacher->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'subject'=>$request->subject,
        ]);
        return response()->json(['message'=>'Teacher update successfully', 'data'=>$teacher]);
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function deleteTeacher($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        return response()->json(['message'=>'Teacher deleted successfully']);
    }
}
