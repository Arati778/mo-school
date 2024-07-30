<?php

use App\Http\Controllers\GuardianController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ValidationUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/validate-otp', [ValidationUserController::class, 'validateOtp']);

Route::post('/teacher', [TeacherController::class, 'teacher']);
Route::get('/teacher/{id}', [TeacherController::class,'getTeacher']);
Route::patch('/teacher/{id}', [TeacherController::class, 'updateTeacher']);
Route::delete('/teacher/{id}',[TeacherController::class,'deleteTeacher']);

Route::post('/student', [StudentController::class, 'student']);
Route::get('/student/{id}', [StudentController::class, 'getStudent']);
Route::patch('/student{id}', [StudentController::class, 'updateStudent']);
Route::delete('/student/{id}', [StudentController::class, 'deleteStudent']);

Route::post('/guardian', [GuardianController::class, 'createGuardian']);
Route::get('/guardian/{id}', [GuardianController::class, 'getGuardian']);
Route::patch('/guardian/{id}', [GuardianController::class, 'updateGuardian']);
Route::delete('/guardian/{id}', [GuardianController::class, 'deleteGuardian']);