<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import controller to be use . 
use App\Http\Controllers\PositionController; 
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); 



Route::post('/position', [ PositionController::class, 'store'] )->name('position.store'); 
Route::get('/position',  [ PositionController::class, 'index'] )->name('position.index'); 