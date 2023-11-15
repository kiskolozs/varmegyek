<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VarmegyeController;
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
    return view('home',);
})->name('home');

//Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('varmegyek', [VarmegyeController::class, 'index'])->name('varmegyek');
Route::post('varmegye', [VarmegyeController::class, 'save'])->name('saveVarmegye');
Route::get('varmegye/create', [VarmegyeController::class, 'create'])->name('createVarmegye');
Route::post('varmegye/{id}', [VarmegyeController::class, 'edit'])->name('editVarmegye');
Route::patch('varmegye/{id}', [VarmegyeController::class, 'update'])->name('updateVarmegye');
Route::delete('varmegye/{id}', [VarmegyeController::class, 'delete'])->name('deleteVarmegye');
Route::post('varmegyek/search', [VarmegyeController::class, 'search'])->name('searchVarmegyek');
