<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
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
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 400);
        }

        $teacher = Teacher::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'subject'=>$request->subject,
        ]);
        return response()->json(['message'=>'Teacher created successfully', 'data'=> $teacher],201);
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
