<?php

namespace App\Http\Controllers;

use App\Models\Mueble;
use App\Models\Material;
use App\Models\Mueble_Material;
use Illuminate\Http\Request;

class MuebleMaterialController extends Controller
{

    /**
     * Display a listing of the resource.
     */

    public function index($mueble)
    {
        try {
            $mueble = Mueble::find($mueble);
            $materiales = Material::all();
            $materialesAsignados = Mueble_Material::where("mueble_id", $mueble->id)->get();
            $materialesAsignados->map(
                function ($material) {
                    $m = Material::find($material->material_id);
                    $material->nombre = $m->nombre;
                    $material->valor = $m->valor;
                }
            );
            return view('editarMueble', ['mueble' => $mueble, 'materiales' => $materiales, "materialesAsignados" => $materialesAsignados]);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('error', 'Error al asignar materiales a mueble');
        }
    }

    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'mueble_id' => 'required',
                'material_id' => 'required',
                'cantidad' => 'required|numeric|gte:0'
            ]);
            Mueble_Material::create($validateData);
            $mueble = Mueble::find($request->mueble_id);
            $materiales = Material::all();
            return view('editarMueble', ['mueble' => $mueble, 'materiales' => $materiales]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function destroy($muebleMaterial)
    {
        try {
            $muebleMaterial = Mueble_Material::find($muebleMaterial);
            if ($muebleMaterial == null) {
                return redirect()->route('dashboard')->with('error', 'Mueble no encontrado');
            }
            $mueble = Mueble::find($muebleMaterial->mueble_id);
            $materiales = Material::all();
            $muebleMaterial->delete();
            return redirect()->route('editarMueble', ['mueble' => $mueble, 'materiales' => $materiales]);
        } catch (\Throwable $th) {
             
            return redirect()->route('editarMueble', ['mueble' => $mueble, 'materiales' => $materiales]);
        }
    }
}
