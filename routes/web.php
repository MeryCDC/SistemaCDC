<?php

//use App\Http\Controllers\BarCodeController;
use App\Http\Controllers\EntradasBodegaController;
use App\Http\Controllers\EntradasImportacionController;
use App\Http\Controllers\SalidasImportacionController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [EntradasImportacionController::class, 'index'])->middleware('auth')->name('home');

Route::group(['middleware' => 'auth'], function () 
{
    Route::get('/', [EntradasImportacionController::class , 'index'])->name('home');
}); 

/*|-------------------------------------------------------------------------- */

Route::resource('/ingresos' , EntradasImportacionController::class );

Route::resource('/entradas' , EntradasBodegaController::class );

Route::get('/ingresos/{id}/guias', [EntradasImportacionController::class, 'show'])->name('ingresos.guias');

Route::get('/etiqueta/{id}', [BarCodeController::class, 'index']);

Route::resource('/salidas' , SalidasImportacionController::class );

Route::get('/salidas/{id}/guias', [SalidasImportacionController::class, 'show'])->name('salidas.guias');

Route::get('/entradas/export-excel', [EntradasBodegaController::class, 'exportExcel'])->name('entradas.excel');
