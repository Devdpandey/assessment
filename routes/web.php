<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index']); 
Route::get('/create', [HomeController::class, 'create'])->name('client.create');
Route::post('/store', [HomeController::class, 'store'])->name('client.store');
Route::get('/client/{key}/edit', [HomeController::class, 'edit'])->name('client.edit');
Route::post('/client/update', [HomeController::class, 'update'])->name('client.update');
Route::get('/client/{key}/delete', [HomeController::class, 'delete'])->name('client.delete');
