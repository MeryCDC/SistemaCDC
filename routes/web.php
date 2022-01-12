<?php

//use App\Http\Controllers\BarCodeController;
use App\Http\Controllers\EntradasBodegasController;
use App\Http\Controllers\EntradasImportacionesController;
use App\Http\Controllers\SalidasImportacionsController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [EntradasImportacionesController::class, 'index'])->middleware('auth')->name('home');

Route::group(['middleware' => 'auth'], function () 
{
    Route::get('/', [EntradasImportacionesController::class , 'index'])->name('home');
}); 

/*|-------------------------------------------------------------------------- */

Route::resource('/ingresos' , EntradasImportacionesController::class );

Route::resource('/entradas' , EntradasBodegasController::class );

Route::get('/ingresos/{id}/guias', [EntradasImportacionesController::class, 'show'])->name('ingresos.guias');

Route::get('/etiqueta/{id}', [BarCodeController::class, 'index']);

Route::resource('/salidas' , SalidasImportacionsController::class );

Route::get('/salidas/{id}/guias', [SalidasImportacionsController::class, 'show'])->name('salidas.guias');

Route::get('/entradas/export-excel', [EntradasBodegaController::class, 'exportExcel'])->name('entradas.excel');
