<?php

namespace App\Http\Controllers;

use App\Models\entradas_bodegas;
use App\Models\int_impo_bods;
use Illuminate\Http\Request;

class EntradasBodegasController extends Controller
{
    
    public function index()
    {}

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $tipo_pqt = "Paqueteria";
        $active = $request->has('tipo_paquete'); 
        if($active){
            $tipo_pqt = "Comercial";
        }

        //Agrego la nueva entrada
         $datos = new entradas_bodegas();
         $datos->tgp = $request->tgp;
         $datos->peso = $request->peso;
         $datos->largo = $request->largo;
         $datos->ancho = $request->ancho;
         $datos->alto = $request->alto;
         $datos->tipo = $tipo_pqt;
         $datos->user_id = $request->user_id;
         $datos->save();  
         $idNuevo = entradas_bodegas::latest('id')->first(); 
         //En caso de ingresar un tracking
         if(!empty($datos->tgp)){
            $cdc = entradas_bodegas::find($idNuevo['id']);
            $searchString = " ";
            $replaceString = "";
            $originalTGP = $idNuevo['tgp']; 
            $outputTGP = str_replace($searchString, $replaceString, $originalTGP); 
            $id_nuestro =  $outputTGP.'-'. $idNuevo['id'];
            $cdc->id_cdc = $id_nuestro;
            $cdc->save();
         }

         //relaciono con la tabla intermedia
         $relacion = new int_impo_bods();
         $relacion->int_impo_id = $request->id_importacion;
         $relacion->int_bod_id = $idNuevo['id'];
         $relacion->save();
         
         return redirect()->route('ingresos.guias' , $request->id_importacion);
         //return response()->json($idNuevo); 
    }

    public function show(entradas_bodegas $entradas_Bodega) 
    {
        //
    }

    public function edit($id)
    {
        $ingreso = entradas_bodegas::find($id);
        return view('entradas.editar', compact('ingreso'));
    }

    public function update(Request $request, $id)
    {
        $ingreso = request()->except('_token' , '_method');
        entradas_bodegas::where('id' , '=' , $id)->update($ingreso); 

        if(!empty($ingreso['tgp'])){
            $cdc = entradas_bodegas::find($id);
            $searchString = " ";
            $replaceString = "";
            $originalTGP = $cdc->tgp; 
            $outputTGP = str_replace($searchString, $replaceString, $originalTGP); 
            $id_nuestro =  $outputTGP.'-'. $cdc->id;
            $cdc->id_cdc = $id_nuestro;
            $cdc->save();
        } 
        return redirect()->route('entradas.edit' , $id)->with('editEntrada', 'Cambios guardados correctamente'); 
    }

    public function destroy($id)
    {
        $ingreso = entradas_bodegas::find($id);
        $int = int_impo_bods::find($ingreso->id);

        int_impo_bods::destroy($ingreso->id);
        entradas_bodegas::destroy($id);
        
        return redirect()->route('ingresos.guias' , $int->int_impo_id);
        //return response()->json($int); 
    }
}
