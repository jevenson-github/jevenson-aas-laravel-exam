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



Route::controller(PositionController::class)->group( function (){

    Route::get('/position', 'index')->name('position.index'); 
    Route::get('/position/{position}', 'show')->name('position.show'); 
    Route::post('/position', 'store' )->name('position.store'); 
    Route::put('/position/{position}' , 'update')->name('position.update'); 
    Route::delete('/position/{position}' ,  'destroy')->name('positon.destroy'); 

});
