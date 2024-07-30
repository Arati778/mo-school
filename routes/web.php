<?php


use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/sent-test-email', function (){
  
    Mail::to('dushbehera05@gmail.com')->send(new WelcomeEmail(12345));
    return 'test email send';
});