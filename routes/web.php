<?php

use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' =>['auth']],function(){


// index
Route::get('indexhome',[UserController::class,'index']);

// adddoctor
Route::get('adddoctor',[UserController::class,'adddoctor']);
Route::post('doctor_insert',[UserController::class,'doctor_insert']);
Route::get('graph_page',[UserController::class,'graph_page']);

// addstaff
Route::get('addstaff',[UserController::class,'addstaff']);
Route::post('staff_insert',[UserController::class,'staff_insert']);

// registerpatient

Route::get('registerpatient',[UserController::class,'registerpatient']);
Route::post('patient_insert',[UserController::class,'patient_insert']);


// addadmin
Route::get('addadmin',[UserController::class,'addadmin']);
Route::post('admin_insert',[UserController::class,'admin_insert']);

});


// Hellow Every one my taks was complete
// Login detail
// admin username-amargrun@gmail.com
// password-123456789

// Doctor username-amar@gmail.com
// password-123456789

// Staff username-naeal@gmail.com
// password-123456789





