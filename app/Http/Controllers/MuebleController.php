<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Mueble;
use App\Models\Mueble_Material;
use Illuminate\Http\Request;

class MuebleController extends Controller
{

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        try {
            $muebles = Mueble::all();

            $muebles->map(function ($mueble) {
                $materiales = Mueble_Material::where("mueble_id", $mueble->id)->get();
                $price = 0;
                $materiales->map(function ($material) use (&$price) {
                    $m = Material::find($material->material_id);
                    $price += $m->valor * $material->cantidad;
                });

                $mueble->price = number_format($price, 0, ',', '.');
            });

            return view('dashboard', ['muebles' => $muebles]);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('error', 'Error al obtener los muebles');
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'nombre' => 'required | min:3',
                'description' => 'required | min:3'
            ]);
            $validateData['estado'] = false;
            $mueble = Mueble::create($validateData);
            return redirect()->route('editarMueble', ["mueble" => $mueble])->with('success', 'Mueble Creado Exitosamente');;
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('error', 'Error al Crear Mueble');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $mueble = Mueble::find($id);
            if ($mueble == null) {
                return response()->json([
                    "error" => "Mueble no Encontrado"
                ]);
            }
            return response()->json([
                "result" => $mueble
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "error" => "Error al encontrar Mueble"
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
    public function update(Request $request, $mueble)
    {
        try {
            $validateData = $request->validate([
                'nombre' => 'required | min:3',
                'description' => 'required | min:3',
                'estado' => 'required'
            ]);
            $mueble = Mueble::find($mueble);
            if ($mueble == null) {
                return redirect()->route('dashboard')->with('error', 'Mueble no encontrado');
            }
            $mueble->nombre = $validateData["nombre"];
            $mueble->description = $validateData["description"];
            $mueble->estado = $validateData["estado"];
            $mueble->save();
            return redirect()->route('editarMueble', ["mueble" => $mueble])->with('success', 'Mueble Editado Correctamente');
            //return view('editarMueble', ["mueble" => $mueble])->with('success', 'Mueble Editado Correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('editarMueble', ["mueble" => $mueble])->with('error', 'Error al editar Mueble: el nombre y descripcion debe tener minimo 3 caracteres');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($mueble)
    {
        try {
            $mueble = Mueble::find($mueble);
            if ($mueble == null) {
                return redirect()->route('dashboard')->with('error', 'Mueble no encontrado');
            }
            $mueble->delete();
            return redirect()->route('dashboard')->with('success', 'Mueble eliminado Correctamente');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('error', 'Error al eliminar Mueble');
        }
    }
}
