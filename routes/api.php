<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/user', [UserController::class, 'store']);
Route::get('/user', [UserController::class, 'show']);
Route::put('/user/{user}', [UserController::class, 'update']);
Route::patch('/user/{user}', [UserController::class, 'edit']);
Route::delete('/user/{user}', [UserController::class, 'destroy']);

Route::post('/role', [RoleController::class, 'store']);
Route::get('/role', [RoleController::class, 'show']);
Route::put('/role/{role}', [RoleController::class, 'update']);
Route::patch('/role/{role}', [RoleController::class, 'edit']);
Route::delete('/role/{role}', [RoleController::class, 'destroy']);
