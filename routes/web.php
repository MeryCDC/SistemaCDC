<?php

use App\Http\Controllers\BarCodeController;
use App\Http\Controllers\EntradasBodegasController;
use App\Http\Controllers\EntradasImportacionesController;
use App\Http\Controllers\SalidasBodegasController;
use App\Http\Controllers\SalidasImportacionsController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [EntradasImportacionesController::class, 'index'])->middleware('auth')->name('home');

Route::group(['middleware' => 'auth'], function () 
{
    Route::get('/', [EntradasImportacionesController::class , 'index'])->name('home');
}); 

/*| ---------------------------------------------------------------------------------------------------------------------------------------------------- */

Route::resource('/ingresos' , EntradasImportacionesController::class )->middleware('auth');

Route::resource('/entradas' , EntradasBodegasController::class )->middleware('auth');

Route::get('/ingresos/{id}/guias', [EntradasImportacionesController::class, 'show'])->name('ingresos.guias')->middleware('auth');

Route::get('/etiqueta/{id}', [BarCodeController::class, 'index']);

Route::resource('/salidas' , SalidasImportacionsController::class )->middleware('auth');

Route::resource('/egresos' , SalidasBodegasController::class )->middleware('auth');

Route::get('/salidas/{id}/guias', [SalidasImportacionsController::class, 'show'])->name('salidas.guias')->middleware('auth');

Route::get('/entradas/export-excel', [EntradasBodegaController::class, 'exportExcel'])->name('entradas.excel')->middleware('auth');
