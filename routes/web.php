<?php

use Illuminate\Support\Facades\Route;

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
/*-------------------------------------------Auth routes----------------------------------------------------------------------------------*/
Route::get('/', [\App\Http\Controllers\StudentRegistration::class,'index']);
Route::post('/storeDetails', [\App\Http\Controllers\StudentRegistration::class, 'storeDetails'])->name('storeDetails');
Route::get('/openLogin', [\App\Http\Controllers\StudentRegistration::class,'openLogin'])->name('openLogin');
Route::any('/login', [\App\Http\Controllers\StudentRegistration::class,'login'])->name('login');
Route::get('/logout', [\App\Http\Controllers\StudentRegistration::class,'logout'])->name('logout');
Route::any('/dashboard', [\App\Http\Controllers\StudentRegistration::class,'dashboard'])->name('dashboard');

/*-------------------------------------------SMS routes-----------------------------------------------------------------------------------*/
Route::get('/openVerify', function () { return view('auth.verify'); })->name('openVerify');
Route::post('/verify', [\App\Http\Controllers\StudentRegistration::class, 'verify'])->name('verify');
Route::post('/reVerify', [\App\Http\Controllers\StudentRegistration::class, 'reVerify'])->name('reVerify');
Route::get('/re-verify', function () { return view('auth.re-verify');})->name('re-verify');

/*-------------------------------------------Send email verification route------------------------------------------------------------------*/
Route::get('/verifyEmail/{token}', [\App\Http\Controllers\StudentRegistration::class,'verifyEmail'])->name('verifyEmail');

/*-------------------------------------------Forgot password routes------------------------------------------------------------------------*/
Route::get('/openResetEmail', [\App\Http\Controllers\StudentRegistration::class, 'openResetEmail'])->name('openResetEmail');
Route::get('/openResetPassword', [\App\Http\Controllers\StudentRegistration::class, 'openResetPassword'])->name('openResetPassword');
Route::post('/resetPasswordEmail', [\App\Http\Controllers\StudentRegistration::class, 'resetPasswordEmail'])->name('resetPasswordEmail');
Route::get('/resetPassword/{passwordToken}', [\App\Http\Controllers\StudentRegistration::class,'resetPassword'])->name('resetPassword');
Route::post('/updatedPassword', [\App\Http\Controllers\StudentRegistration::class,'updatedPassword'])->name('updatedPassword');

/*-------------------------------------------Catpcha verification codes--------------------------------------------------------------------*/
Route::get('/reloadCaptcha', [\App\Http\Controllers\StudentRegistration::class, 'reloadCaptcha'])->name('reloadCaptcha');

/*--------------------------------------------Return student data in json format-------------------------------------------------------------*/
Route::any('viewStudents', [\App\Http\Controllers\StudentRegistration::class, 'viewStudents'])->name('viewStudents');
