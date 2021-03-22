<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Wx\AuthController;

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


Route::get('/home', function () {
    return "hello world and laravel";
});

Route::post('wx/auth/register', [AuthController::class, 'register']);
Route::post('wx/auth/regCaptcha', [AuthController::class, 'regcaptcha']);
