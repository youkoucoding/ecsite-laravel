<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Wx\AuthController;
use App\Http\Controllers\Wx\BrandController;
use App\Http\Controllers\Wx\GoodsController;
use App\Http\Controllers\Wx\CatalogController;

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
Route::post('wx/auth/login', [AuthController::class, 'login']);

Route::get('wx/catalog/index', [CatalogController::class, 'index']);
Route::get('wx/catalog/current', [CatalogController::class, 'current']);

Route::get('wx/brand/list', [BrandController::class, 'list']);
Route::get('wx/brand/detail', [BrandController::class, 'detail']);

Route::get('/wx/goods/', [GoodsController::class,]);
Route::get('/wx/goods/', [GoodsController::class,]);
Route::get('/wx/goods/', [GoodsController::class,]);
Route::get('/wx/goods/');
