<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'prevent-back-history'],function(){
        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('login',[AuthController::class, 'index'])->name('login');
        Route::post('post-login',[AuthController::class, 'postLogin'])->name('login.post');
        Route::group(['middleware' => 'auth'], function(){
            Route::post('post-register',[AuthController::class, 'postRegister'])->name('register.post');
            Route::post('delete/user',[AuthController::class, 'deleteUser'])->name('delete.user');
            Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
            Route::post('create/project', [ProjectController::class, 'createProject'])->name('create.project');
            Route::post('delete/project', [ProjectController::class, 'deleteProject'])->name('delete.project');
            Route::post('create/role', [RoleController::class, 'createRole'])->name('create.role');
            Route::post('delete/role', [RoleController::class, 'deleteRole'])->name('delete.role');
            
            Route::get('project/details/{id}', [ ProjectController::class, 'projectDetails'])->name('project.details');
            Route::get('update/project/{id}', [ ProjectController::class, 'updateProjectForm'])->name('update.project');
            Route::get('complete/project/{id}', [ ProjectController::class, 'completeProject'])->name('complete.project');
            Route::post('update/project', [ ProjectController::class, 'updateProject'])->name('update.project');
            
            
            Route::get('/logout', [ AuthController::class, 'logout'])->name('logout');
        });
    });