<?php

use App\Http\Controllers\CoordController;
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
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/getCoord', [CoordController::class, 'getCoordinates'])->name('getCoord')->middleware('auth');
Route::post('/addCoord', [CoordController::class, 'store'])->name('addCoord')->middleware('auth');
Route::get('/', function () {
    return view('app');
})->middleware('auth');


// Route::get('/esri', function () {
//     return view('welcome');
// });
