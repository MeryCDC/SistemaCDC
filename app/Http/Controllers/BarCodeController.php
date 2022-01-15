<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\entradas_bodegas;

class BarCodeController extends Controller
{
    // index
    public function index($id)
    {
        /* id */
        $guiaBodega = entradas_bodegas::join('int_impo_bods' , 'int_impo_bods.int_bod_id', '=', 'entradas_bodegas.id')
        ->where('entradas_bodegas.id', '=', $id)
        ->get();

        //return response()->json($guiaBodega); 

         //Obtengo todas las guias de la importacion seleccionada
         /* $guiasImportaciones=int_impo_bods::join('entradas_importaciones' , 'int_impo_bods.int_impo_id', '=', 'entradas_importaciones.id')
         ->join('entradas_bodegas' , 'int_impo_bods.int_bod_id', '=', 'entradas_bodegas.id')
         ->join('users' , 'entradas_bodegas.user_id', '=', 'users.id')
         ->select('entradas_bodegas.id' , 'entradas_bodegas.tgp' , 'entradas_bodegas.peso', 'entradas_bodegas.tipo', 'entradas_bodegas.largo', 'entradas_bodegas.id_cdc',
         'entradas_bodegas.ancho', 'entradas_bodegas.alto', 'entradas_bodegas.peso_volumetrico', 'entradas_bodegas.volumen', 'users.name')
         ->where('entradas_importaciones.id', '=', $id)
         ->get(); */


        return view('barcode.index', compact('guiaBodega'));
    }
}
