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
        $guia = entradas_bodegas::findOrFail($id);
        return view('barcode.index', compact('guia'));
    }
}
