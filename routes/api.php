<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/getProjectByUserId', [UserController::class, 'getProjectByUserId']); 
Route::get('/getAllUser', [UserController::class, 'getAllUser']); 

Route::post('/updateprocess', [ProjectController::class, 'updateProcess']); 
Route::post('/findprojectbycode', [ProjectController::class, 'findProjectByCode']);  
Route::post('/projectdetail', [ProjectController::class, 'projectDetail']);
 