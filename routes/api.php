<?php

use App\Http\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->name('user')->group(function () {
    Route::get('', [UserController::class, 'getAll'])->name('.get-all');
    Route::post('', [UserController::class, 'create'])->name('.create');
    Route::post('/{id}', [UserController::class, 'edit'])->name('.edit');
});
