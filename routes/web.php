<?php

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

Route::get('/', function () {
    return redirect(route('user.index'));
});

Route::get('/import-data', [\App\Http\Controllers\ImportDataController::class, 'index']);
Route::get('/get-data-by-imei', [\App\Http\Controllers\GetDataController::class, 'getDataByImei']);
Route::get('/get-access-history', [\App\Http\Controllers\GetDataController::class, 'getAccessHistory']);
Route::get('/get-data-by-target', [\App\Http\Controllers\GetDataController::class, 'getDataByTarget']);

Route::get('/user', [\App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::prefix('chat')->name('chat')->group(function() {
    Route::get('/', [\App\Http\Controllers\ChatController::class, 'index'])->name('.index');
});
