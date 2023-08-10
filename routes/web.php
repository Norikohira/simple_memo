<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemoController;

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



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/memo/store', [MemoController::class, 'store'])->name('memo.store');
Route::get('/memo/{id}/edit', [MemoController::class, 'edit'])->name('memo.edit');
Route::patch('/memo/{id}/update', [MemoController::class, 'update'])->name('memo.update');
Route::delete('/memo/{id}/destroy', [MemoController::class, 'destroy'])->name('memo.destroy');
