<?php

namespace App\Http\Controllers;

use App\Models\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function student(Request $request)
    {

      $validator =  Validator::make($request->all(),[
       'fisrt_name'=> 'required|string|max:255',
       'last_name'=> 'required|string|max:255',
       'gender'=> 'required|string|in:male,female,other',
       'dob'=> 'required|date',
       'address'=> 'required|string|max:300',
       'phone'=> 'required|string|max:300',
        ]);

        if($validator->fails()){
            return response()->json(['error'=> $validator->errors()->all()], 400);
        }

       $student =  Student::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'gender'=>$request->gender,
            'dob'=>$request->dob,
            'address'=>$request->address,
            'phone'=>$request->phone,
        ]);
        return response()->json(['message'=>'Student created successfuly', 'data'=>$student]);
    }

    /**
     * Show the form for creating a new resource.
     */
        public function getStudent($id)
        {
           $student = Student::findOrFail($id);
            return response()->json(['data'=>$student]);
        }

    /**
     * Store a newly created resource in storage.
     */
    public function updateStudent(Request $request, $id)
    {
       $student = Student::findOrFail($id);
       $student->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'dob'=>$request->dob,
            'address'=>$request->address,
            'phone'=>$request->phone,
       ]);
       return response()->json(['message'=>'student updated successfully', 'dara'=>$student]);
    }


    public function deleteStudent(Request $request,$id)
    {
       $student = Student::findOrFail($id);
       $student->delete();
       return response()->json(['message'=>'student deleted successfully']);
    }
}
