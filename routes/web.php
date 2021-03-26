<?php

use App\Http\Controllers\CoordController;
use App\Http\Controllers\LoginController;
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

Auth::routes([
    'login' => false,
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

// Login
Route::get('/login', [LoginController::class, 'show_login_form'])->name('login');
Route::post('/login', [LoginController::class, 'process_login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/getCoord', [CoordController::class, 'getCoordinates'])->name('getCoord')->middleware('auth');
Route::post('/addCoord', [CoordController::class, 'store'])->name('addCoord')->middleware('auth');
Route::post('/updateCoord', [CoordController::class, 'update'])->name('updateCoord')->middleware('auth');
Route::get('/getDetailCoord', [CoordController::class, 'getDetailCoord'])->name('getDetailCoord')->middleware('auth');
Route::get('/getMarkerImage', [CoordController::class, 'getMarkerImage'])->name('getMarkerImage')->middleware('auth');
Route::get('/', [CoordController::class, 'show'])->name('/')->middleware('auth');
Route::get('/home', function () {
    return view('app');
})->middleware('auth');
Route::get('/checkApi', [CoordController::class, 'checkApi'])->name('checkApi');
Route::get('/getApiKey', [CoordController::class, 'getApiKey'])->name('getApiKey');
Route::get('/list', [CoordController::class, 'list'])->name('list')->middleware('auth');
Route::get('/getFilterRecord', [CoordController::class, 'getFilterRecord'])->name('getFilterRecord')->middleware('auth');

//API getallMastertoForm
Route::get('/getJenisUsaha', [CoordController::class, 'getJenisUsaha'])->name('getJenisUsaha')->middleware('auth');
Route::get('/getBahanBaku', [CoordController::class, 'getBahanBaku'])->name('getBahanBaku')->middleware('auth');
Route::get('/getPenjualanBahan', [CoordController::class, 'getPenjualanBahan'])->name('getPenjualanBahan')->middleware('auth');
Route::get('/getPembayaran', [CoordController::class, 'getPembayaran'])->name('getPembayaran')->middleware('auth');
Route::get('/getMesin', [CoordController::class, 'getMesin'])->name('getMesin')->middleware('auth');
Route::post('/delCoord', [CoordController::class, 'delCoord'])->name('delCoord')->middleware('auth');

// Route::get('/esri', function () {
//     return view('welcome');
// });
