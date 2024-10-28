<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
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


Route::get('/login', [AuthController::class, 'loginView'])->name('auth.loginView'); 
Route::post('/login', [AuthController::class, 'login'])->name('auth.login'); 

Route::get('/register', [AuthController::class, 'registerView'])->name('auth.registerView'); 
Route::post('/register', [AuthController::class, 'register'])->name('auth.register'); 

Route::post('/forgot', [AuthController::class, 'forgotPass'])->name('auth.forgotPass'); 
Route::get('/forgot', [AuthController::class, 'forgot'])->name('auth.forgot'); 

Route::get('/changepass', [AuthController::class, 'changePassView'])->name('auth.changePassView'); 

Route::get('/emailverified', [AuthController::class, 'emailverifiedView'])->name('auth.emailverifiedView'); 
Route::post('/emailverified', [AuthController::class, 'emailverified'])->name('auth.emailverified'); 

Route::post('/changepass', [AuthController::class, 'changePass'])->name('auth.changePass'); 

Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout'); 


// middleware group 
Route::middleware(['authencation'])->group(function () { 
    Route::get('/', [UserController::class, 'HomePage'])->name('user.HomePage');
    Route::post('/createproject', [ProjectController::class, 'createProject'])->name('project.createProject');
    Route::get('/createproject', [ProjectController::class, 'createProjectView'])->name('project.createProjectView');
    Route::get('/projectdetail', [ProjectController::class, 'ProjectDetailView'])->name('project.ProjectDetailView');
    Route::get('/editproject', [ProjectController::class, 'updateProjectView'])->name('project.updateProjectView');
    Route::post('/update', [ProjectController::class, 'updateProject'])->name('project.updateProject');
});