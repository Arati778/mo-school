<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuardianController extends Controller
{
    public function createGuardian(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name'=> 'required|string|max:255',
            'last_name'=> 'required|string|max:255',
            'phone'=> 'required|string|max:255',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()], 400);
        }

        $guardian = Guardian::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'phone'=>$request->phone,
        ]);
        return response()->json(['message'=>'Guardian created successfully', 'data'=>$guardian]);
    }

    public function getGuardian($id)
    {
       $guardian = Guardian::findOrFail($id);
        return response()->json(['data'=>$guardian]);
    }

    public function updateGuardian(Request $request, $id)
    {
        $guardian = Guardian::findOrFail($id);
        $guardian->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'phone'=>$request->phone,
        ]);
        return response()->json(['message'=>'Guardian updated successfully', 'data'=>$guardian]);
    }

    public function deleteGuardian($id)
    {
       $guardian = Guardian::findOrFail($id);
        $guardian->delete();
        return response()->json(['message'=>'guardian deleted successfully']);
    }

}
