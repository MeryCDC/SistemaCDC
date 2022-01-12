<?php

namespace App\Http\Controllers;

use App\Models\entradas_importaciones;
use App\Models\int_impo_bods;
use Illuminate\Http\Request;

class EntradasImportacionesController extends Controller
{
    public function index()
    {
        //Obtengo todas las importaciones
        $ingresos=entradas_importaciones::join('users' , 'entradas_importaciones.user_id', '=', 'users.id')
        ->select('entradas_importaciones.id', 'entradas_importaciones.created_at' ,'users.name')
        ->orderBy('entradas_importaciones.id', 'desc')
        ->get();
        return view('ingresos.index', compact('ingresos'));
        //return response()->json($ingresos);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //Creo la importacion
        $datos= new entradas_importaciones();
        $datos->user_id = $request->user_id;
        $datos->save(); 
        return redirect('ingresos');
    }

    public function show($id)
    {
         //Obtengo todas las guias de la importacion seleccionada
         $guiasImportaciones=int_impo_bods::join('entradas_importaciones' , 'int_impo_bods.int_impo_id', '=', 'entradas_importaciones.id')
         ->join('entradas__bodegas' , 'int_impo_bods.int_bod_id', '=', 'entradas__bodegas.id')
         ->join('users' , 'entradas__bodegas.user_id', '=', 'users.id')
         ->select('entradas__bodegas.id' , 'entradas__bodegas.tgp' , 'entradas__bodegas.peso','entradas__bodegas.largo', 'entradas__bodegas.id_cdc',
         'entradas__bodegas.ancho', 'entradas__bodegas.alto', 'entradas__bodegas.peso_volumetrico', 'entradas__bodegas.volumen', 'users.name')
         ->where('entradas_importaciones.id', '=', $id)
         ->get();

         return view('ingresos.guias', compact('guiasImportaciones' , 'id'));  
         //return response()->json($guiasImportaciones); 
    }

    public function edit(entradas_importaciones $entradas_Importacion)
    {
        //
    }

    public function update(Request $request, entradas_importaciones $entradas_Importacion)
    {
        //
    }

    public function destroy(entradas_importaciones $entradas_Importacion)
    {
        //
    }
}
