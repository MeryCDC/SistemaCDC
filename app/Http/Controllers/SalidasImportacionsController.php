<?php

namespace App\Http\Controllers;

use App\Models\salidas_importacions;
use App\Models\out_impo_bods;
use Illuminate\Http\Request;

class SalidasImportacionsController extends Controller
{
    public function index()
    {
        //
        $salidas = salidas_importacions::join('users' , 'salidas_importacions.user_id', '=', 'users.id')
        ->select('salidas_importacions.id', 'salidas_importacions.created_at' ,'users.name')
        ->orderBy('salidas_importacions.id', 'desc')
        ->get();
        return view('salidas.index', compact('salidas'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $datos= new salidas_importacions();
        $datos->user_id = $request->user_id;
        $datos->save(); 

        return redirect('salidas');
    }

    public function show($id)
    {
        //Obtengo todas las guias de la importacion seleccionada
        $guiasImportaciones=out_impo_bods::join('salidas_importacions' , 'out_impo_bods.out_imp_id', '=', 'salidas_importacions.id')
        ->join('salidas_bodegas' , 'out_impo_bods.out_bod_id', '=', 'salidas_bodegas.id')
        ->join('users' , 'salidas_bodegas.user_id', '=', 'users.id')
        ->select('salidas_bodegas.id' , 'salidas_bodegas.peso', 'salidas_bodegas.id_cdc', 'users.name')
        ->where('salidas_importacions.id', '=', $id)
        ->get();

       return view('salidas.guias', compact('guiasImportaciones' , 'id'));  

        //return view('salidas.guias');  
        //return response()->json($guiasImportaciones); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salidas_Importacion  $salidas_Importacion
     * @return \Illuminate\Http\Response
     */
    public function edit(salidas_importacions $salidas_Importacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salidas_Importacion  $salidas_Importacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, salidas_importacions $salidas_Importacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salidas_Importacion  $salidas_Importacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(salidas_importacions $salidas_Importacion)
    {
        //
    }
}
