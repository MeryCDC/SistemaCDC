<?php

namespace App\Http\Controllers;

use App\Models\entradas_bodegas;
use App\Models\out_impo_bods;
use App\Models\salidas_bodegas;
use Illuminate\Http\Request;

class SalidasBodegasController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $idCDC = "";
        $peso_original = "";
        $guiasImportaciones = entradas_bodegas::where('tgp', '=', $request->tgp)->orWhere('id', '=' , $request->tgp)->get();
        
        foreach($guiasImportaciones as $guia){
            $idCDC = $guia['id_cdc'];
            $peso_original = $guia['peso'];
        }
        
        if(sizeof($guiasImportaciones) > 0){
            if (empty($guia->id_cdc)) {
                return redirect()->route('salidas.guias' , $request->id_importacion)->with('messageVacio', 'Vacio');
            }  else {
                $diferencia = $request->peso - $peso_original;
                $datos = new salidas_bodegas();
                $datos->peso_salida = $request->peso;
                $datos->peso_diferencia = $diferencia;
                $datos->id_cdc = $idCDC;
                $datos->user_id = $request->user_id;
                $datos->guia_transportadora = $request->guia_transportadora;
                $datos->save(); 
                $idNuevo = salidas_bodegas::latest('id')->first(); 
    
                //relaciono con la tabla intermedia
                $relacion = new out_impo_bods();
                $relacion->out_imp_id = $request->id_importacion;
                $relacion->out_bod_id = $idNuevo['id'];
                $relacion->save(); 
    
                return redirect()->route('salidas.guias' , $request->id_importacion);
            }
        } else {
            return redirect()->route('salidas.guias' , $request->id_importacion)->with('messageEntrada', 'Vacio');
        }
        
        return redirect()->route('salidas.guias' , $request->id_importacion);
        //return response()->json($idNuevo); 
    }

    public function show(salidas_bodegas $salidas_bodegas)
    {
        //
    }

    public function edit(salidas_bodegas $salidas_bodegas)
    {
        //
    }

    public function update(Request $request, salidas_bodegas $salidas_bodegas)
    {
        //
    }

    public function destroy(salidas_bodegas $salidas_bodegas)
    {
        //
    }
}
