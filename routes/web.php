<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cadastrar', [App\Http\Controllers\CadRastreioController::class, 'index'])->name('cadastrar');
Route::get('/exportar', [App\Http\Controllers\CadRastreioController::class, 'exportar'])->name('exportar');
Route::get('/exportarMes', [App\Http\Controllers\CadRastreioController::class, 'exportarMes'])->name('exportarMes');
Route::get('/buscar', [App\Http\Controllers\CadRastreioController::class, 'buscar'])->name('buscar');
Route::get('/remove/{id}', [App\Http\Controllers\CadRastreioController::class, 'remove'])->name('remove');
Route::post('/cadastrar/save', [App\Http\Controllers\CadRastreioController::class, 'save'])->name('cadastrarCodRastreio');

