<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusinessController;
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
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group (function() {

Route::get('business', [BusinessController::class, 'index']);
Route::post('business', [BusinessController::class, 'store']);
Route::get('business/{id}', [BusinessController::class, 'show']);
Route::get('business/{id}/edit', [BusinessController::class, 'edit']);
Route::put('business/{id}/edit', [BusinessController::class, 'update']);
Route::delete('business/{id}/delete', [BusinessController::class, 'destroy']);
});
