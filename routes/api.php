<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/teacher', [TeacherController::class, 'teacher']);
Route::get('/teacher/{id}', [TeacherController::class,'getTeacher']);
Route::patch('/teacher/{id}', [TeacherController::class, 'updateTeacher']);
Route::delete('/teacher/{id}',[TeacherController::class,'deleteTeacher']);

Route::post('/student', [StudentController::class, 'student']);
