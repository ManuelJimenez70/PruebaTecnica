<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(){
        try {
            $materiales = Material::all();
            return view('materiales', ['materiales' => $materiales]);     
        } catch (\Throwable $th) {
            return view('dashboard');    
        }
    }

    public function create(){
        try {
            $materiales = Material::all();
            return response()->json([
                "materiales" => $materiales
            ]);        
        } catch (\Throwable $th) { 
            return response()->json([
                "error" => "Error al obtener materiales: ".$th->getMessage()
            ]);    
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        try {
            $validateData = $request -> validate([
                'nombre' => 'required | min:3',
                'valor' => 'required|numeric|gte:0'
            ]);
            Material::create($validateData);
            return redirect() -> route('materiales')->with('success', 'Material creado Correctamente');
        } catch (\Throwable $th) {
            return redirect() -> route('materiales')->with('error', 'Error al Crear Materia');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $material = Material::find($id);
            if($material == null){
                return response()->json([
                    "error" => "Material no Encontrado"
                ]);  
            }
            return response()->json([
                "result" => $material
            ]);         
        } catch (\Throwable $th) {
            return response()->json([
                "error" => "Error al encontrar Material"
            ]);         
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $material){
        try {
            $validateData = $request->validate([ 
                'nombre' => 'required | min:3',
                'valor' => 'required|numeric|gte:0'
            ]);
            $material = Material::find($material);
            if($material == null){
                return redirect() -> route('materiales')->with('error', 'Material no encontrado');
            }
            $material->nombre = $validateData["nombre"];
            $material->valor = $validateData["valor"];
            $material->save();
            return redirect() -> route('materiales')->with('success', 'Material editado Correctamente');
        } catch (\Throwable $th) {
            return redirect() -> route('materiales')->with('error', 'Error al editar Material');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($material){
        try {
            $material = Material::find($material);
            if($material == null){
                return redirect() -> route('materiales')->with('error', 'Material no encontrado'); 
            }
            $material->delete();
            return redirect() -> route('materiales')->with('success', 'Material eliminado Correctamente');
        } catch (\Throwable $th) {
            return redirect() -> route('materiales')->with('error', 'Error al eliminar Material');        
        }
    }
}
